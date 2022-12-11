# Task for Laravel Demo App

## 1) Registration page functionality

Registration form with the following fields:

- Username
- Phone number

After registration, the user receives a generated unique link to the main page,
access to which will be available for seven days through this unique link.

After the time expires, the link becomes invalid.

## 2) Main page functionality
   
- Button to copy your unique link;
- Button to generate a new unique link;
- Button to deactivate the current unique link;
- "I'm feeling lucky" button. After clicking on the "I'm feeling lucky" button, the user will be shown:
  - Random number from 1 to 1000;
  - Win/Lose result.
- If the random number is paired, display the result to the user Win.
- Otherwise, display the Lose result to the user;
- Amount Win:
  - If the random number is over 900, the winning amount must be 70% of the random number;
  - If the random number is over 600, the winning amount must be 50% of the random number;
  - If the random number is over 300, the winning amount must be 30% of the random number;
  - If the random number is less than 300, the winning amount must be 10% of the random number.
- History button.
- After clicking on the "History" button, the user is shown information about the last 3 results of clicking on the "Im feeling lucky" button.

## 3) Working with the database

- Data must be stored in the database:
  - Registered users;
  - The results of clicking on the button "I'm feeling lucky".

## 4) Admin panel

- In the admin panel, you need to implement the following functions:
  - List of all users;
  - User editing;
  - User creation;
  - Deleting a user.
