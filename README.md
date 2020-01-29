# metlog
PWS (Personal Weather Station) aggregator and relay (Windy)
Marlon van der Linde <marlonv@pm.me>

# Stations tested
Fine Offset WH3000SE and possibly its related clones (Froggit)

# Description
This interface can be placed on a simple PHP host and once the station (EasyWeather) is directed to push custom calls to it, can be used to retain data in a local store or submitted elsewhere. 

# Current Status

- Tested with WINDY - Seems to be working OK
- OpenWeatherMap - Not yet working
- Storage to SQLite - TODO
- Create Persistence class, and derived 'Windy', 'OpenWeatherMap', 'Redis', 'SQLite' child-classes

# config

Create a `conf.dat` in the hosted directory.
See the example conf included in the repository.

With the config in place, and station.php hosted, simply set up EasyWeather to submit to it.

# Hardware

I created this for my Froggit WH3000SE station, which is also cloned/rebranded as Fine Offset and some others.
When setting up the upstream data stores on the WSView App (EasyWeather on the Console) there are options for WU, EcoWITT and custom.
This script must be called from custom with your preferred security keys in place. It works for me, but eventually better logging and the classes will make things better looking and easier to debug. I just needed it to work quickly, so here it is, shared. Please help improve it.


THIS DOCUMENT IS BARE ESSENTIALS, IT WILL BE UPDATED WHEN I HAVE PRETTIFIED THE CODE
