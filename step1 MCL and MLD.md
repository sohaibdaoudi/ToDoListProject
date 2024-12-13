To design a **Model Conceptual Data (MCD)** and **Model Logical Data (MLD)** for your to-do list website, we can define the entities, attributes, and relationships in the MCD and then translate them into tables in the MLD.

---

### **MCD (Model Conceptual Data)**

#### **Entities:**
1. **User**:
   - Attributes:
     - User ID (Primary Key)
     - Name
     - Email (Unique)
     - Password

2. **Task**:
   - Attributes:
     - Task ID (Primary Key)
     - Title
     - Description
     - Status (e.g., Pending, Completed)
     - Due Date
     - Created Date

#### **Relationships:**
1. **A User can have multiple Tasks** (One-to-Many relationship):
   - A user is linked to their tasks.

---

### **MLD (Model Logical Data)**

#### **Tables:**
1. **Users**:
   ```sql
   CREATE TABLE Users (
       user_id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100),
       email VARCHAR(100) UNIQUE,
       password VARCHAR(255)
   );
   ```

2. **Tasks**:
   ```sql
   CREATE TABLE Tasks (
       task_id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT,
       title VARCHAR(200),
       description TEXT,
       status ENUM('Pending', 'Completed') DEFAULT 'Pending',
       due_date DATE,
       created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
   );
   ```

---

### **Password Recovery Mechanism**
- Add a column for a **password recovery token** and its expiration time in the `Users` table:
  ```sql
  ALTER TABLE Users 
  ADD recovery_token VARCHAR(255),
  ADD token_expiry DATETIME;
  ```

When a user forgets their password:
1. A unique token is generated and stored in `recovery_token`, with an expiry time set in `token_expiry`.
2. An email is sent to the user with the token to reset their password.
3. The token is validated when the user attempts to reset the password.

---

Would you like to include diagrams (e.g., ERD) or further expand on the design?
