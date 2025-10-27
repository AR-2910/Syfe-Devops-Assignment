# 🧩 Syfe Infra Assignment – DevOps (Production-grade WordPress Deployment on Kubernetes)

## 🚀 Project Overview

This repository contains my completed submission for the **Syfe Infra Intern – DevOps** assignment.

The project demonstrates a **production-grade WordPress application** deployed on **Kubernetes** using **Helm**, backed by **Nginx (OpenResty with Lua)** and **MySQL**, with a fully integrated **monitoring and alerting stack (Prometheus & Grafana)**.

All assignment objectives have been successfully implemented, verified, and documented with **screenshots** for proof of execution.

---

## ✅ assignment objectives achieved:
- End-to-end WordPress app running on Kubernetes.  
- Nginx compiled with Lua (OpenResty).  
- Custom Dockerfiles for all components.  
- Persistent storage using ReadWriteMany volumes (via NFS Subdir Provisioner).  
- Helm-based deployment and cleanup.  
- Prometheus + Grafana monitoring stack configured.  
- Nginx and Pod CPU metrics collected and visualized.  
- Alert rules implemented for CPU utilization and HTTP 5xx errors.  
- Screenshots provided for all verifications.

---

## 🎯 Assignment Objectives and Implementation

### **Objective #1: Run a Production-grade WordPress app on Kubernetes**
#### 🧱 Implementation Summary
- **Persistent Storage:**
  - Created `PersistentVolume` and `PersistentVolumeClaim` for both WordPress and MySQL.
  - Used **ReadWriteMany** volume support with **NFS Subdir External Provisioner** Helm chart.
- **Custom Dockerfiles:**
  - Built three custom Docker images:
    - `Dockerfile.wordpress`
    - `Dockerfile.mysql`
    - `Dockerfile.nginx` (with Lua via OpenResty)
  - Implemented proxy pass from Nginx → WordPress.
- **OpenResty (Nginx + Lua) Build:**
  - Compiled OpenResty with Lua support using the exact configuration required:
    ```bash
    ./configure --prefix=/opt/openresty \
    --with-pcre-jit \
    --with-ipv6 \
    --without-http_redis2_module \
    --with-http_iconv_module \
    --with-http_postgres_module \
    -j8
    ```
  - Lua scripts for metrics and test functionality are under `docker/lua/`.
- **Helm-based Deployment:**
  - Complete Helm chart created under `charts/wordpress/`.
  - Easy deployment and cleanup:
    ```bash
    helm install wordpress ./charts/wordpress
    helm uninstall wordpress
    ```
- **Reverse Proxy Setup:**
  - All requests are proxied from **Nginx to WordPress** using `nginx.conf` and `nginx-config-cm.yaml`.

---

### **Objective #2: Setup Monitoring and Alerting for the WordPress App**

#### 🧠 Implementation Summary
- **Prometheus & Grafana Stack:**
  - Deployed using official Helm charts for ease and reliability.
  - Integrated into the Kubernetes cluster for system and application metrics.
- **Nginx Monitoring:**
  - Added **Nginx Exporter** for metrics.
  - Verified endpoint:
    ```bash
    curl http://localhost:9114/metrics | grep nginx_
    ```
  - Metrics collected include:
    - `nginx_connections_active`
    - `nginx_http_requests_total`
    - `nginx_up`
    - `nginx_connections_waiting`, etc.
- **Custom Prometheus Monitoring Config:**
  - `ServiceMonitor` created for Nginx under:
    ```
    charts/monitoring/templates/servicemonitor-nginx.yaml
    ```
  - `PrometheusRule` for alerting defined in:
    ```
    charts/monitoring/templates/alert-rules.yaml
    ```
- **Grafana Dashboards:**
  - Visualized:
    - Nginx request/connection metrics.
    - Pod CPU utilization (cluster-level view).
- **Alerting:**
  - Configured Prometheus alerts for:
    - High Pod CPU usage.
    - Nginx 5xx errors.
  - Alerts tested and visible in Prometheus targets.
    
---

## 🌟 Implementation Highlights 

| Area | Implementation |
|------|----------------|
| 🧰 Helm-based Modular Deployment | All services (WordPress, MySQL, Nginx, Monitoring) structured under Helm charts |
| 📂 RWX Volumes | RWX storage achieved with NFS Subdir Provisioner |
| 🧮 Custom Nginx Exporter Metrics | Lua-enabled metrics via OpenResty |
| ⚙️ Observability | Prometheus + Grafana with dashboards and alerting |
| 🚨 Alerts | CPU usage and Nginx 5xx error alerting rules |
| ☁️ Kubernetes Metrics | Visualized cluster-level CPU, memory, and pod metrics via Prometheus & Grafana |
| 🧾 Documentation | Full step-by-step README and screenshots included |

---

## 📸 Proof of Work (Screenshots)

Located under the `/screenshots` folder.

---

## 📊 Metrics Tracked

### **WordPress**
- Pod status and uptime  
- CPU and memory utilization  
- Pod restarts (to monitor reliability)  

### **MySQL**
- Resource utilization and uptime  
- Active connections and query performance  
- PVC binding for persistent data storage  

### **Nginx**
- Request and connection metrics exported through **nginx-prometheus-exporter**
- Key tracked metrics:
  - `nginx_http_requests_total` — total handled requests  
  - `nginx_connections_active` — number of active client connections  
  - `nginx_connections_waiting` — idle client connections  
  - `nginx_up` — exporter health status  
  - `nginx_connections_writing` — active response writes  
  - `nginx_connections_reading` — active header reads  
  - `nginx_connections_accepted` — total accepted connections  
  - `nginx_http_requests_total{status="5xx"}` — error tracking for alerts  

---

## ⚠️ Alerts and Monitoring Rules

Alert rules and service monitors are implemented in the **monitoring Helm chart**:

- **File:** `charts/monitoring/templates/alert-rules.yaml`
  - **CPU Utilization Alert:** triggers when Pod CPU usage crosses defined threshold.
  - **Nginx 5xx Request Alert:** fires on 5xx HTTP response spike, indicating app or reverse proxy errors.

- **File:** `charts/monitoring/templates/servicemonitor-nginx.yaml`
  - Defines Nginx exporter scraping rules and Prometheus job labels.

Both these configurations ensure continuous monitoring and real-time visualization in Grafana.

---

## 📜 Lua Integration (OpenResty)

The **Nginx layer** uses **OpenResty (Nginx + Lua)** to extend functionality and enable scripting-based metrics and response control.

- Lua scripts located under - docker/lua/
- Lua enables light-weight logic inside Nginx, making it extensible and scriptable for analytics and control tasks.

---

## 🧾 Notes

- Monitoring and alerting configs:  
Located in `charts/monitoring/templates/`  
(`alert-rules.yaml`, `servicemonitor-nginx.yaml`)

- Helm charts for the application:  
Located in `charts/wordpress/`  
(`nginx-deployment.yaml`, `wordpress-deployment.yaml`, `mysql-deployment.yaml`, etc.)

- Dockerfiles for all components:  
Located in `docker/`  
(`Dockerfile.nginx`, `Dockerfile.wordpress`, `Dockerfile.mysql`)

- Nginx configuration and Lua scripts:  
In `docker/nginx.conf` and `docker/lua/`

- Screenshots for verification and validation:  
In `screenshots/`

---

## 🏁 Summary

This project demonstrates expertise over **DevOps pipeline and Kubernetes orchestration**.

It covers:
- Application containerization  
- Helm-based deployment  
- Storage provisioning (RWX)  
- Monitoring and alerting (Prometheus + Grafana)  
- Lua-enabled Nginx customization

This submission demonstrates readiness for a real-world infrastructure environment, with reproducible, production-grade Kubernetes and DevOps practices.  
