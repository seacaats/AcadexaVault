## 📚  AcadexaVault  
### PHINMA–University of Pangasinan Academic Repository System

AcadexaVault is a web-based system that we created for PHINMA–University of Pangasinan. It serves as a digital archive where students and faculty can upload and access research papers, theses, and other academic works.

This project is one of our major requirements.

---

## 🧠 Background

Nowadays, students from Senior High School to College are required to create research papers as part of their academic requirements. But most of these works are stored in flash drives, folders, or computers — and eventually get lost or forgotten.

Our idea is to create a system where these papers can be safely stored, properly organized, and easily searched by others — even in the future. This will help preserve and showcase the research output of our school community.

---

## 🎯 Project Goals

- Collect and store research papers in one place  
- Help users find papers easily through search and filters  
- Make it easier for the school to manage and showcase academic work  
- Provide access to papers for students, teachers, and even outside users

---

## 👥 Who Can Use This System

- Students who want to upload or search for papers  
- Faculty members who guide or submit research  
- Admins who manage the system and monitor usage  
- Visitors or researchers looking for local studies

---

## 🧰 Features

Here are some of the main features of AcadexaVault:

- Login system for users and admins  
- Upload research papers (PDF format)  
- Admin can update or delete papers if needed  
- Search by title, author, course, or year  
- View papers online and download them  
- Add comments and reviews to papers  
- Star rating system (1 to 5 stars)  
- Generate citations (APA or MLA format)  
- Track how many people viewed or downloaded a paper  
- Admin dashboard for usage reports

---

## 🛠️ Tools and Technologies Used

We used the WAMP stack because it's easy to set up and works well for our project:

- Windows (OS)  
- Apache (Web Server)  
- MySQL (Database)  
- PHP (Backend – native, no frameworks)  
- XamppServer for local hosting  
- phpMyAdmin to manage the database

---

## 🖥️ How to Run the Project (Local Setup)

1. Install XAMPP on your computer.
2. Copy the project folder into: C:/xampp/htdocs/ (or C:/xampp64/htdocs/ if you installed XAMPP in that directory)
3. Open phpMyAdmin by going to http://localhost/phpmyadmin in your browser.
4. Create a new database (e.g., acadexavault).
5. Import the provided .sql file into your new database.
6. Edit config.php and update the database credentials if necessary (e.g., DB name, username, password).
7. Start Apache and MySQL from the XAMPP Control Panel.
8. Run the system by visiting: http://localhost/acadexavault

---

## ⚙️ How to Set Up the Required Dependencies and Variables

1. ### Tailwind (through Node)

    Setting this up may only be necessary if Tailwind's utility classes don't render correctly.
    - Go to https://nodejs.org/en/download and download node.js (LTS versions are recommended).
    - Open the downloaded executable or zip and install node.js on your computer.
    - Go to the **Command Line Interface (CLI)** and the project's directory and type in **'npm -v'** to get your node's version as a way to test it.
    - Since **'package.json'** is already initialized for this repository, we can move on to the next step.
    - Go to https://tailwindcss.com/docs/installation/tailwind-cli and follow the procedure (While still on the project's directory).
    - Test if the utility classes or stylings render as they should.

2. ### PHPMailer (through Composer)

    This is important as the sending of emails in our authentication processes relies on PHPMailer.
    - Go to https://getcomposer.org/download/ to download and run composer on your computer.
    - Run the installation wizard and choose the php file based on your chosen local environment
    - If you're using XAMPP as instructed, go to it's directory, then click the php folder, and choose **'php.exe'**.
    - Open your computer's CLI and go to the project's directory, then type in **'composer'** to get a log of your composer as a way to test it.
    - Then, type in **'composer require phpmailer/phpmailer'** to install phpmailer on the directory.
    - Change the directory accordingly to the project repository's structure.

3. ### Environment Variables

     You should've noticed the **'.env.example'** on the project's repository, this is part of the process of sending emails.
    - Rename the file to '.env' and check the contents
    - These variables are utilized in the **'src/controllers/functions.php'** file in relation to the email sending process.
    - The server and ports have default values but you can change them accordingly.
    - As for the username, and password, you have to utilize your own email and it's app password.
    - What is an app password? An **app password** is one that is utilized for temporary access of an account when using it on a device that doesn't support modern security measures.
    - This can be attained through your google account and by turning on Two-Factor Authentication, and going to https://myaccount.google.com/apppasswords to create one and copy it.
    - Finally paste the necessary values on your **'.env'** file and test the functionality.
    - You might've also noticed the hardcoded values on the **'functions.php'**, setting the **setFrom** and **addReplyTo** with default values.
    - To have an authentic experience by sending emails through our dedicated email **'acadexa.up@gmail.com'**, you may request to use it as an alias for your account.
    - Here, you can set up your host, port, and connection configurations (Note that the password refers to the app password you created and will use).

---

## 🚀 What We Plan to Improve

In the future, we want to add:

- A better mobile layout (responsive design)  
- Full-text search inside the PDF  
- Simple plagiarism checker  
- Paper recommendation feature  
- API access for research-related platforms

---

## 👨‍💻 Project Developers

This system was created by us — 2nd year BSIT students from PHINMA–University of Pangasinan:

- **Phea Mae DC. Peralta** – Project Manager  
- **Janelle Mhyca M. Soria** – Systems Analyst  
- **John Ivan De Guzman** – Programmer  
- **Maricar E. Ferrer** – Database Administrator  
- **Lian Patrick G. Perez** – Documentation Specialist

**School Year:** 2025–2026  

---

## 📬 Contact Us

For any questions or suggestions, feel free to reach out:

📧 acadexa.up@gmail.com  
📍 PHINMA – University of Pangasinan, Dagupan City

---

## ⚠️ Disclaimer

This project was created for academic purposes only. It is not intended for commercial use.
