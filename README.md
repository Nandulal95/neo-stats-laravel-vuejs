
Asteroid - Neo Stats
Instructions
The specification for the test application below applies to both web and mobile applications. If you have applied for a Web Developer position then build the Web app. If you have applied for the Mobile app developer position, then build the mobile application (either Android or iOS).

Please make sure that you write your best code as this test is basically to evaluate your coding skills. Specially make sure:
Your code is architected well
Code should be modular and reusable
Code should follow standard coding conventions
Code should be secure and follow best practices
Code should be commented and documented
Summary
Neo stands for Near-Earth Objects. Nasa provides an open API and in this problem, we will be using the Asteroid NeoWs API.

We want to plot a line chart showing the number of asteroids passing near the Earth each day for the given date range as well as find the nearest asteroid and the fastest asteroid.
Data Source
NASA’s Open API -> https://api.nasa.gov (Go to Browse APIs -> Asteroids - NeoWs -> Neo - Feed)
Neo Feed
Retrieve a list of Asteroids based on their closest approach date to Earth
https://api.nasa.gov/neo/?api_key=DEMO_KEY


Web or Mobile Application
This should be a single-page web/mobile application. Feel free to use any reactive JS libraries like VueJS, AngularJS, or anything you like. If you are building a mobile application then use similar technologies available for your platform. Use Twitter Bootstrap or Tailwind for the UI on the web and equivalent technologies for mobile platforms. For the backend, use the technology you are applying for (Laravel, PHP, CodeIgniter, WordPress, Java - Android, Swift - iOS, etc.)
User Story
As a user, I want to select/enter start and end dates so that I can view the Neo Stats for that date range.

Provide a way (input) for the user to specify the start and end dates. Use a date picker for the respective form fields.

Once the dates are selected, the user will hit “Submit”. On Submit, fetch the Neo Feed from NASA’s open API for the given date range and show the following output:



A) Show the following stats (calculated from the data you will receive from Neo Feed)
Fastest Asteroid in km/h (Respective Asteroid ID & its speed)
Closest Asteroid (Respective Asteroid ID & its distance)
Average Size of the Asteroids in kilometers

B) Plot a graph showing the total number of asteroids for each day of the given date range. Use a bar or line chart for the same.
Use https://www.chartjs.org/ to plot the chart on the web and equivalent library for the mobile platforms. Or any other charting library of your choice.

Version Control
Put your source code in a Git repository (Bitbucket or Github) and share the URL to the same.

Deployment
Deploy the APP on free Heroku or AWS or Azure (or any other free cloud hosting provider) and share the URL for testing. This is NOT compulsory but if you can do this, it will give you an added advantage.

Notes
You can refer to respective manuals/docs
You are free to get ideas online but DO NOT copy/paste the code
Feel free to get in touch should you need any clarifications
Please follow PSR4 coding conventions (if using PHP/Laravel for the backend)

#Preview 1 initial
![alt text](https://github.com/Nandulal95/neo-stats-laravel-vuejs/blob/main/public/images/task-1a.png?raw=true)

#preview 2 after date selection
![alt text](https://github.com/Nandulal95/neo-stats-laravel-vuejs/blob/main/public/images/task-1b.png?raw=true)
