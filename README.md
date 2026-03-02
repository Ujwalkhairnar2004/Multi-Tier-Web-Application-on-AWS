🏗️ Highly Available Multi-Tier Application on AWS

Production-Grade 3-Tier Architecture using VPC, Auto Scaling, Load Balancer, and RDS (MySQL)

📌 Project Overview

This project demonstrates the deployment of a highly available, scalable, and secure Multi-Tier Web Application in AWS.

The architecture follows industry best practices:

Network isolation using public & private subnets

High availability across 2 Availability Zones

Auto Scaling for elasticity

Application Load Balancer for traffic distribution

Amazon RDS (MySQL) deployed in private subnets

NGINX reverse proxy architecture

Strict Security Group isolation between tiers

🏛️ Architecture Overview
🔹 3-Tier Architecture Model
1️⃣ Web Tier (Presentation Layer)

NGINX running on EC2

Serves index.html

Reverse proxies traffic to Application Tier

Deployed in Public Subnets

Attached to Application Load Balancer

2️⃣ Application Tier (Business Logic Layer)

PHP application (submit.php)

Processes user requests

Connects securely to RDS MySQL

Deployed in Private Subnets

Auto Scaling enabled

3️⃣ Database Tier (Data Layer)

Amazon RDS (MySQL)

Multi-AZ deployment

No public access

Accessible only from App Tier

🌐 Network Design
VPC Configuration

1 Custom VPC

CIDR block: 10.0.0.0/16

Subnet Design (8 Subnets Total)
🌍 Public Subnets
Subnet	AZ
Public-A	AZ-A
Public-B	AZ-B
🔒 Private Subnets – Web Tier
Subnet	AZ
Web-A	AZ-A
Web-B	AZ-B
🔒 Private Subnets – App Tier
Subnet	AZ
App-A	AZ-A
App-B	AZ-B
🔒 Private Subnets – DB Tier
Subnet	AZ
DB-A	AZ-A
DB-B	AZ-B
🛣️ Routing Configuration
Public Route Table
0.0.0.0/0 → Internet Gateway (IGW)

Used by:

Public-A

Public-B

Private Route Tables

Internal routing only

No direct Internet access

DB subnets fully isolated

<img width="1366" height="768" alt="{56D0C02D-A761-4DB1-8B30-B36911A35547}" src="https://github.com/user-attachments/assets/155ea59c-a7cc-4967-85a6-dde1dbe411a8" />

🧱 AWS Components Used

VPC

Internet Gateway (IGW)

Route Tables

Application Load Balancer (ALB)

Auto Scaling Group

EC2 Instances

Amazon RDS (MySQL)

Security Groups

🖥️ Application Tier

PHP file: submit.php

Handles form submission

Connects to MySQL RDS database

Example DB connection snippet:

$conn = new mysqli($host, $username, $password, $database);
🌍 Web Tier (NGINX)

File: index.html

NGINX configuration with reverse proxy

Proxies traffic to App Tier DNS

nginx.conf Example
server {
    listen 80;

    location / {
        proxy_pass http://<APP-TIER-DNS>;
    }
}

🗄️ Database Tier

Amazon RDS

Engine: MySQL

Deployed in private subnets (DB-A, DB-B)

Multi-AZ enabled

No public access

<img width="1366" height="768" alt="{010877FB-4CD4-4851-A698-C4F5133CB213}" src="https://github.com/user-attachments/assets/776b0b82-a812-47db-b0b7-9e2e81be5231" />

⚖️ High Availability & Scalability

Deployed across 2 Availability Zones

Auto Scaling Group for Web/App EC2

Application Load Balancer distributes traffic

RDS Multi-AZ for database failover

<img width="1366" height="768" alt="{CDBF77BC-FF3F-40B7-848C-AD8EC4A17AB3}" src="https://github.com/user-attachments/assets/6fb64693-57dd-4dd6-8981-0a0c5431e326" />

<img width="1366" height="768" alt="{B365B3FD-93BF-441B-9E4E-A64A6577F738}" src="https://github.com/user-attachments/assets/e7db3794-8d41-4ea6-a3af-88dd91d7edeb" />

<img width="1366" height="768" alt="{D8CE1DC9-4762-4CE6-BD5E-8B9DEA563A1D}" src="https://github.com/user-attachments/assets/86e01223-6a1b-48e8-81e2-301d3e13f591" />

🔐 Security

Web Tier Security Group:

Allow HTTP (80) from Internet

App Tier Security Group:

Allow traffic from Web Tier only

DB Security Group:

Allow MySQL (3306) from App Tier only

RDS is NOT publicly accessible

<img width="1366" height="768" alt="{7538B502-CA63-4449-971A-B594F1CDEDFA}" src="https://github.com/user-attachments/assets/25b355bb-b8a3-480f-abcf-543557fcb1c3" />


📂 Project Structure
├── index.html wed
├── submit.php  app
├── nginx.conf  wed
└── README.md

<img width="1366" height="768" alt="{DC4CA93D-86BE-4F36-8368-A6FCFD9B052F}" src="https://github.com/user-attachments/assets/56c50394-e8d0-49db-9021-951da69a6d99" />

🚀 Deployment Steps (Summary)

Create VPC

Create Public & Private Subnets (2 AZ)

Attach Internet Gateway

Configure Route Tables

Create Security Groups

Launch RDS (MySQL) in private DB subnets

Launch EC2 for App Tier in private subnets

Configure PHP and DB connection

Launch EC2 for Web Tier in public subnets

Configure NGINX reverse proxy

Create Target Group

Create Application Load Balancer

Create Auto Scaling Group


🎯 Key Learning Outcomes

VPC and Subnet design

Route table configuration

Secure multi-tier architecture

NGINX reverse proxy setup

RDS private deployment

Load balancing & Auto Scaling

High availability in AWS

output:

https://github.com/user-attachments/assets/e0dae87c-fd4b-419c-98d3-64fbdddd729a

👨‍💻 Author

Ujwal Ganesh Khairnar
