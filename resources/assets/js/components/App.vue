<template>
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 ms-sm-auto px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Daily Neo Stats</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button class="btn btn-sm btn-outline-secondary" id="exampleModalButton" data-bs-toggle="modal"
                                href="#exampleModalToggle"
                                role="button">Change Date
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-around">
                    <p>
                        1.Fastest Asteroid in km/h (Respective Asteroid ID & its speed) <br>
                        -> Asteroid ID: {{ fastest_asteroid.id }}, <br>
                        -> its speed: {{
                            fastest_asteroid.close_approach_data?.map((data) => data.relative_velocity.kilometers_per_hour).join("")
                        }} Km/h,
                    </p>

                    <p>
                        2.Closest Asteroid (Respective Asteroid ID & its distance) <br>
                        -> Asteroid ID: {{ closest_asteroid.id }} <br>
                        -> its distance: {{
                            closest_asteroid.close_approach_data?.map((data) => data.miss_distance.kilometers).join("")
                        }} kilometers<br>
                    </p>

                    <p>
                        3.Average Size of the Asteroids in kilometers <br>
                        -> Average Size: {{ average_asteroid }} kilometers <br>
                    </p>
                </div>
                <canvas class="my-4 w-100" id="myChart" width="2304" height="972"
                        style="display: block; height: 486px; width: 1152px;">
                </canvas>
            </main>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form v-on:submit.prevent="submit()">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Date Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="modal-close-btn"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="form-label">Start Date</label>
                            <input type="date" class="form-control" v-model="start_date">
                        </div>
                        <div class="form-group">
                            <label for="form-label">End Date</label>
                            <input type="date" class="form-control" v-model="end_date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>
<script>
import Chart from 'chart.js/auto';

export default {
    data() {
        return {
            chart: null,
            chartOptions: {
                type: 'bar',
                data: {},
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            },
            start_date: '',
            end_date: '',
            fastest_asteroid: '',
            closest_asteroid: '',
            average_asteroid: ""
        }
    },
    mounted() {
        console.log(this.$route.query.start_date)
        console.log(this.$route.query.end_date)
        if (this.$route.query.start_date !== 'undefined' && this.$route.query.end_date !== 'undefined') {
            document.getElementById('exampleModalButton').click();
        } else {
            this.start_date = this.$route.query.start_date;
            this.end_date = this.$route.query.end_date;
            this.loadFeed();
        }
    },
    methods: {
        async submit() {
            this.$router.push({
                query: {
                    start_date: this.start_date,
                    end_date: this.end_date
                }
            });
            await this.loadFeed();
        },
        async loadFeed() {
            try {
                if (this.chart) {
                    this.chart.destroy();
                }
                const feed = await axios.get('/api/neo/feed?start_date=' + this.start_date + '&end_date=' + this.end_date);
                this.chartOptions.data = feed.data.data.chartBar;
                this.fastest_asteroid = feed.data.data.fastest_asteroid;
                this.closest_asteroid = feed.data.data.closest_asteroid;
                this.average_asteroid = feed.data.data.average_asteroid;
                this.chart = new Chart(document.getElementById('myChart'), this.chartOptions);
                document.getElementById('modal-close-btn').click();

            }catch (error){
                alert(error);
            }
        }
    }
}
</script>
