<?php

// WIP Placeholder - storage to sqlite - coming soon

function databaseOpenPrep() {
    if ($db = sqlite_open(DBFILE, 0666, $sqliteerror)) { 
        if (!$db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='conditions'")) {
            $db->query($create_conditions);
        }
    } else {
        die($sqliteerror);
    }

    $create_conditions = 
    'CREATE TABLE IF NOT EXISTS conditions (
        id INTEGER PRIMARY KEY,
        stationId INTEGER NOT NULL,
        tempIndoor REAL NOT NULL,
        tempIndoor REAL NOT NULL,
        temp REAL NOT NULL,
        dewpoint REAL NOT NULL,
        windchill REAL NOT NULL,
        humidityIndoor INTEGER NOT NULL,
        humidity INTEGER NOT NULL,
        windSpeed REAL NOT NULL,
        windGust REAL NOT NULL,
        barometerAbs REAL NOT NULL, 
        barometer REAL NOT NULL,
        rainin REAL NOT NULL,
        dailyrainin REAL NOT NULL,
        weeklyrainin REAL NOT NULL,
        monthlyrainin REAL NOT NULL,
        solarradiation REAL NOT NULL,
        UV INTEGER NOT NULL,
        dateutc NUMERIC NOT NULL,
        softwaretype TEXT NOT NULL,
        action TEXT NOT NULL,
        realtime NUMERIC NOT NULL,
        rtfreq NUMERIC NOT NULL
    );';

    // basic checks passed, table exists... 
}
