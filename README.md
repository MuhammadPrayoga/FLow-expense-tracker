# FLow Expense Tracker

FLow is a web-based expense tracker built with CodeIgniter 4, Bootstrap 5, and Chart.js. It helps users manage their finances with features like user authentication, transaction management, budgeting, and reporting with PDF export.

## Features
- User authentication (login, register, logout)
- Transaction management (add, edit, delete transactions)
- Budget management
- Reporting with period filter and PDF export
- Visualizations using Chart.js (pie charts for expenses/income)
- Responsive dark theme design with Bootstrap 5

## Tech Stack
- **Backend**: CodeIgniter 4 (PHP framework)
- **Frontend**: Bootstrap 5, Chart.js (via CDN)
- **Database**: MySQL
- **PDF Export**: dompdf library

## Installation
1. Clone the repository:
git clone https://github.com/MuhammadPrayoga/flow-expense-tracker.git <pre><code>
2. Install dependencies: </code></pre> composer install <pre><code>
3. Set up the database: - Create a MySQL database named `flow_tracker`. - Import the `database.sql` file into the database. 
4. Configure the environment: - Copy `.env.example` to `.env` and update database credentials. 
5. Run the project: </code></pre> php spark serve <pre><code>
6. Access the app at `http://localhost:8080`.

## License
This project is licensed under the GNU General Public License v3.0 (GPL-3.0). However, the CodeIgniter framework used in this project is licensed under the MIT License (see the original LICENSE file in the CodeIgniter documentation).