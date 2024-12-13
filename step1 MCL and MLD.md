Here's the updated **MCD** and **MLD** with the addition of the `name` attribute for the **User** entity.

---

### **Updated MCD (Modèle Conceptuel de Données)**

1. **User**
   - Attributes:
     - `id_user` (Primary Key, unique identifier)
     - `name` (user's full name)
     - `email` (unique)
     - `password`
     - `security_code` (for password recovery)

2. **Task**
   - Attributes:
     - `id_task` (Primary Key, unique identifier)
     - `title`
     - `description`
     - `due_date`
     - `status` (e.g., Pending, Completed, Overdue)
     - `priority` (e.g., High, Medium, Low)

3. **Relationships**
   - A `User` *can have* multiple `Tasks` (**1,N** cardinality).
   - Each `Task` *belongs to* one `User` (**1,1** cardinality).

---

### **Updated MLD (Modèle Logique de Données)**

#### 1. **Users**
| Column Name       | Data Type        | Constraints                 |
|--------------------|------------------|-----------------------------|
| `id_user`         | INT (PK)         | AUTO_INCREMENT, NOT NULL   |
| `name`            | VARCHAR(255)     | NOT NULL                   |
| `email`           | VARCHAR(255)     | UNIQUE, NOT NULL           |
| `password`        | VARCHAR(255)     | NOT NULL                   |
| `security_code`   | VARCHAR(10)      | NOT NULL                   |

#### 2. **Tasks**
| Column Name       | Data Type        | Constraints                 |
|--------------------|------------------|-----------------------------|
| `id_task`         | INT (PK)         | AUTO_INCREMENT, NOT NULL   |
| `id_user`         | INT (FK)         | REFERENCES Users(id_user)   |
| `title`           | VARCHAR(255)     | NOT NULL                   |
| `description`     | TEXT             | NULL                       |
| `due_date`        | DATE             | NULL                       |
| `status`          | ENUM('Pending', 'Completed', 'Overdue') | DEFAULT 'Pending' |
| `priority`        | ENUM('High', 'Medium', 'Low') | DEFAULT 'Medium' |

---

### Updated Features:
- The **User** table now includes a `name` column to store the user's full name.
- This allows personalized interactions on the website (e.g., "Welcome, [Name]!").

Would you like a visualization (ERD) or SQL code to create these tables?
