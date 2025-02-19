# AI Text Detector

## Overview
AI Text Detector is a web application that allows users to detect AI-generated text from various sources. It supports PDF file uploads, text input, and provides limited free usage for new users before authentication. The app is built with **Laravel (backend)** and **React (frontend)** using **MongoDB** and **MySQL** for data storage. Authentication is handled via **Laravel Sanctum**.

## Features
### **Core Functionalities**
- **AI-Generated Text Detection**: Analyze input text to determine if it is AI-generated.
- **Free Limited Usage**: New users can test the AI detection feature three times before authentication is required.
- **PDF Import & Export**:
  - Upload PDF files containing text for AI analysis.
  - Extract text from PDFs using **smalot/pdfparser** in Laravel.
  - Export results to PDF using **dompdf**.
- **Authentication & User Management**:
  - Secure login and registration with Laravel Sanctum.
  - Role-based access control for users and admins.
  - API authentication for protected routes.

### **Frontend (React)**
- **React with Redux Toolkit** for state management.
- **React Router DOM** for navigation.
- **Tailwind CSS** for responsive UI design.
- **File Upload System** using `useForm` from `react-hook-form` and `axios`.
- **PDF Processing**:
  - Upload PDFs and send them to the backend.
  - Display extracted text and allow exporting results.

### **Backend (Laravel)**
- **API Routes in `api.php`** for handling requests.
- **MySQL Database** for user authentication and analytics.
- **MongoDB** for storing text data and AI analysis results.
- **PDF Text Extraction** using `smalot/pdfparser`.
- **PDF Generation** using `dompdf`.
- **AI Text Detection Algorithm** (can integrate with OpenAI API or custom model).

## Installation & Setup
### **Requirements**
- Node.js & npm
- PHP 8 & Composer
- MySQL & MongoDB
- Laravel 10

### **Backend (Laravel)**
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/ai-text-detector.git
   cd ai-text-detector/backend
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Configure environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Set up database:
   ```bash
   php artisan migrate
   ```
5. Serve the application:
   ```bash
   php artisan serve
   ```

### **Frontend (React)**
1. Navigate to the frontend directory:
   ```bash
   cd ../frontend
   ```
2. Install dependencies:
   ```bash
   npm install
   ```
3. Start the development server:
   ```bash
   npm start
   ```

## API Endpoints
### **User Authentication**
- `POST /api/register` - Register a new user.
- `POST /api/login` - Authenticate user and return token.
- `POST /api/logout` - Logout user.

### **AI Text Detection**
- `POST /api/detect` - Submit text for AI analysis.
- `POST /api/upload-pdf` - Upload a PDF file and extract text.

### **Admin Dashboard**
- `GET /api/dashboard` - Retrieve analytics (new users, total submissions, etc.).
- `GET /api/users` - Manage users.

## Future Enhancements
- **AI Model Integration**: Improve accuracy using OpenAI, Hugging Face, or custom NLP models.
- **User Dashboard**: View history of analyzed texts.
- **Subscription Model**: Introduce premium plans for extended usage.

## License
This project is open-source under the MIT License.

## Contributors
- **Ameur** - [LinkedIn](https://linkedin.com/in/yourprofile) | [Fiverr](https://www.fiverr.com/yourgig)

## Contact
For inquiries or collaborations, feel free to reach out via email: your-email@example.com

