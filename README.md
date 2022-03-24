# Plant Management System "Cactus"

Cactus is a web application that helps users take better care of houseplants.

This app will notify users when the plants should be watered, by setting up an IoT sensor equipment around the plant.

## Preview

### Dashboard

<img src="https://github.com/quicksilversel/cactus/blob/main/img/index.png" width="500" />

In this page, users will be able to check the overall status of their plants. 
‘Watered plants’ section shows the number of plants that need to be watered. 
‘Urgent watering needed’ section shows the number of plants that are in critical condition 
(i.e. the current humidity or temperature is too different from its optimal humidity or temperature), 
and needs to be watered immediately. 
In the ‘watering history’ section, users are able to check the date when their plants were last wateterd. 
Last but not least, the graph in overview shows the average humidity level of their current location, 
and also visualizes the number of times the plants were watered by month. 

### Status 

<img src="https://github.com/quicksilversel/cactus/blob/main/img/status.png" width="500" />

In this page, users will be able to check the status of all of their plants in a table view. 
The table contains the following information : name of the plant, optimal humidity, current humidity, status, warnings, and last watered date. 
In the status column, a green checkmark will be shown if the plant is in a healthy state and does not need to be watered. 
Otherwise, a red crossmark will be shown. In the warnings column, a warning mark will be shown if a plant is in critical condition.

### Plants Data

<img src="https://github.com/quicksilversel/cactus/blob/main/img/plantsdata.png" width="500" />

In this page, users will be able to check the optimal humidity level, optimal temperature and the native habitat for popular houseplants. 
Every plant has a different humidity level and temperature that is ideal for their growth. 
For example, a cactus has an optimal temperature of 7℃-30℃, and an optimal humidity level of 40%-60%. On the other hand, 
a snake plant has an optimal temperature of 15℃-30℃ and an optimal humidity level of 40-60%. 
Checking these data will help users decide when they want to be notified. 
