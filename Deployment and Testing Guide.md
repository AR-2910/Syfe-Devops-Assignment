# 🧩 Deployment and Testing Guide — DevOps Assignment

This document provides a detailed step-by-step guide to **deploy and test** the production-grade **WordPress application on Kubernetes** as per the Syfe Infra Internship assignment objectives.

---
## ⚙️ Prerequisites

Ensure the following tools are installed and configured on your local or cloud environment:
- **Docker** – to build container images  
- **kubectl** – to manage Kubernetes resources  
- **Helm** – for packaging and deploying charts  
- **Minikube / Kind / EKS / GKE** – a running Kubernetes cluster  
- **Git** – for repository management  
---

## 🧱 Step 1: Clone the Repository

```bash
git clone https://github.com/AR-2910/Syfe-Devops-Assignment.git
cd syfe-devops-assignment
```
---

## 🐳 Step 2: Build Docker Images
Build images for **WordPress**, **MySQL**, and **OpenResty (Nginx with Lua)**.

```bash
# Build WordPress Image
docker build -t wordpress-custom:latest -f wordpress/Dockerfile .

# Build MySQL Image
docker build -t mysql-custom:latest -f mysql/Dockerfile .

# Build Nginx (OpenResty with Lua) Image
docker build -t nginx-openresty:latest -f nginx/Dockerfile .
```

Verify the builds:
```bash
docker images
```
---

## 📦 Step 3: Add and Verify Helm Repositories

```bash
helm repo add prometheus-community https://prometheus-community.github.io/helm-charts
helm repo add grafana https://grafana.github.io/helm-charts
helm repo update
```
---

## 🚀 Step 4: Deploy WordPress Application using Helm
Deploy the complete WordPress stack (WordPress + MySQL + Nginx) using the provided Helm chart.

```bash
helm install syfe-wordpress ./helm/wordpress
```

Verify:
```bash
helm list
kubectl get all
```

Check PersistentVolumes and PersistentVolumeClaims:
```bash
kubectl get pv,pvc
```
---

## 🔍 Step 5: Access the Application
Retrieve service details:
```bash
kubectl get svc
```

If using Minikube:
```bash
minikube service syfe-wordpress-nginx-service
```
This will open the WordPress site in your browser via Nginx (OpenResty) acting as a reverse proxy.
---

## 📊 Step 6: Deploy Monitoring Stack (Prometheus + Grafana)
Use official public Helm charts for monitoring setup.

### Deploy Prometheus
```bash
helm install prometheus prometheus-community/kube-prometheus-stack
```

### Verify Installation
```bash
kubectl get pods -n default | grep prometheus
```

### Access Grafana
Grafana is included in the `kube-prometheus-stack` release.

```bash
kubectl get svc
kubectl port-forward svc/prometheus-grafana 3000:80
```
Access Grafana at [http://localhost:3000](http://localhost:3000)  
Default credentials:  
- **Username:** admin  
- **Password:** prom-operator  
---

## 📈 Step 7: Setup Dashboards and Alerts
### Import Dashboards
1. In Grafana → **Dashboards → Import**  
2. Import:
   - **Nginx Metrics Dashboard**
   - **WordPress/Apache Metrics Dashboard**
   - **Kubernetes Cluster Metrics Dashboard**
### Configure Alerts
Alerting rules are configured in:
```
monitoring/alerting-rules.yaml
```

Includes alerts for:
- Pod CPU utilization  
- Nginx total request count  
- 5xx error rate  

Apply the alerting configuration:
```bash
kubectl apply -f monitoring/alerting-rules.yaml
```
---

## 🧾 Step 8: Verify Metrics and Alerts
- Validate **Nginx metrics** (5xx count, total requests)
- Confirm **WordPress pod CPU metrics** in Grafana
- Trigger sample alerts to ensure proper alert routing
Access:
- **Prometheus:** [http://localhost:9090](http://localhost:9090)  
- **Grafana:** [http://localhost:3000](http://localhost:3000)
---

## 🧹 Step 9: Cleanup
To uninstall all components cleanly:

```bash
# Remove WordPress release
helm uninstall syfe-wordpress

# Remove monitoring stack
helm uninstall prometheus
```

Verify cleanup:
```bash
kubectl get all
helm list
```
