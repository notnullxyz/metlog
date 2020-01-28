# metlog
PWS (Personal Weather Station) aggregator and relay (Windy)

# Stations tested
Fine Offset WH3000SE and possibly its related clones (Froggit)

# Description
This interface can be placed on a simple PHP host and once the station (EasyWeather) is directed to push custom calls to it, can be used to retain data in a local store or submitted elsewhere. 

# Current Status

- Tested with WINDY - Seems to be working OK
- OpenWeatherMap - Not yet working
- Storage to SQLite - Not yet working

# config

Create a `conf.dat` in the hosted directory, looking something like this:

```
; MetLog configuration and Secrets File

[app]
logfile = data.log
dbfile = metlog.sqlite
date_format = "d-M-Y H:i:s"

; configs pertaining to open weather map. Get station ID by creating/POST'ing a new station
[openweathermap]
openweathermap_apikey = getyourapikeyfromopenweathermap
openweathermap_host = api.openweathermap.org
openweathermap_station_id = somestationidafteryoucreatedastation

; this is the security key/id you can configure on EasyWeather on your station side.
[station]
station_secretkey = f00p4sswordformyst4tion
station_secretid = 1

[windy]
windy_apikey = getYourVeryLongWindyAPIatWindyAndPutItHere
windy_url = https://stations.windy.com/pws/update/
windy_stationID = 0
```

With the config in place, and station.php hosted, simply set up EasyWeather to submit to it.


THIS DOCUMENT IS BARE ESSENTIALS, IT WILL BE UPDATED WHEN I HAVE PRETTIFIED THE CODE
