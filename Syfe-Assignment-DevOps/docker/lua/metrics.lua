local dict = ngx.shared.metrics

local function access()
  dict:incr("requests_total", 1)
  local status = ngx.var.status
  ngx.log(ngx.INFO, "Request to: " .. ngx.var.uri .. " with status: " .. status)
  if tonumber(status) >= 500 then
    dict:incr("errors_5xx_total", 1)
    ngx.log(ngx.ERR, "5xx Error: " .. status)
  end
end

local function metrics()
  local requests_total = dict:get("requests_total") or 0
  local errors_5xx_total = dict:get("errors_5xx_total") or 0
  ngx.header.content_type = "text/plain"
  ngx.say("# HELP nginx_requests_total Total number of HTTP requests")
  ngx.say("# TYPE nginx_requests_total counter")
  ngx.say("nginx_requests_total " .. requests_total)
  ngx.say("# HELP nginx_errors_5xx_total Total number of 5xx errors")
  ngx.say("# TYPE nginx_errors_5xx_total counter")
  ngx.say("nginx_errors_5xx_total " .. errors_5xx_total)
end

if ngx.var.uri == "/metrics" then
  metrics()
else
  access()
end
