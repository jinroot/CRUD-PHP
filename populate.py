import mysql.connector
from faker import Faker
import random

# Connect to your MySQL server
connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="jinroot",
    database="mycvproject"
)

# Create a Faker instance
faker = Faker()

# Function to generate random data and insert into person table
def generate_person_data():
    cursor = connection.cursor()
    for _ in range(10):  # Insert 10 random persons
        fname = faker.first_name()
        lname = faker.last_name()
        address = faker.address()
        city = faker.city()
        country = faker.country()
        email = faker.email()
        cursor.execute("INSERT INTO person (fName, lName, Address, city, country, Email) VALUES (%s, %s, %s, %s, %s, %s)",
                       (fname, lname, address, city, country, email))
    connection.commit()
    cursor.close()

# Function to generate random data and insert into other tables
def generate_other_data(table_name, field_name):
    cursor = connection.cursor()
    cursor.execute("SELECT idperson FROM person")
    person_ids = cursor.fetchall()
    for person_id in person_ids:
        person_id = person_id[0]
        num_entries = random.randint(1, 3)  # Random number of entries between 1 and 3
        for _ in range(num_entries):
            if table_name == 'app':
                data = faker.word() + " App"
            elif table_name == 'course':
                data = faker.word() + " Course"
            elif table_name == 'hobby':
                data = faker.word() + " Hobby"
            elif table_name == 'language':
                data = faker.word() + " Language"
            elif table_name == 'project':
                data = faker.word() + " Project"
            elif table_name == 'site':
                data = faker.word() + " Site"
            cursor.execute(f"INSERT INTO {table_name} ({field_name}, person_idperson) VALUES (%s, %s)", (data, person_id))
    connection.commit()
    cursor.close()

# Generate data for each table
generate_person_data()
generate_other_data('app', 'appName')
generate_other_data('course', 'courseName')
generate_other_data('hobby', 'hobbyName')
generate_other_data('language', 'languageName')
generate_other_data('project', 'projectName')
generate_other_data('site', 'siteName')

# Close the connection
connection.close()
