# PayNinja - Laravel Order Management System

A robust order management system built with Laravel featuring step-by-step order processing with asynchronous job handling.

## Key Features

- **Step-wise Order Processing**: Initiate → Address → Payment → Async Processing → Completion
- **Database Transactions**: Ensures data integrity at each step
- **Queue Workers**: Background processing for payment and fulfillment
- **RESTful API**: Clean endpoints for each order step
- **Validation**: Strict input validation at each stage

here are few snippets of postman ( api testing )

//cancel order 
<img width="1522" height="916" alt="Screenshot from 2025-08-07 15-01-00" src="https://github.com/user-attachments/assets/f3538fda-552f-4f04-b7ab-677201896fcb" />

//order initiation
<img width="1522" height="916" alt="Screenshot from 2025-08-07 14-56-50" src="https://github.com/user-attachments/assets/6447dda0-3a23-48f9-abb9-982a48ee15c6" />

//order address (optional)
<img width="1522" height="916" alt="Screenshot from 2025-08-07 14-58-00" src="https://github.com/user-attachments/assets/c3d750a1-5970-49cd-babc-8e083eed2ac3" />

//order payment(optional)
<img width="1522" height="916" alt="Screenshot from 2025-08-07 14-58-35" src="https://github.com/user-attachments/assets/8ae5b343-82ef-4759-9ecd-0cad959bc80f" />

