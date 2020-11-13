/*
This file is part of McWebPanel.
Copyright (C) 2020 Cristina Ibañez, Konata400

    McWebPanel is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    McWebPanel is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with McWebPanel.  If not, see <https://www.gnu.org/licenses/>.
*/

$(document).ready(function() {

    $("#form-player-idle-timeout").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-max-build-height").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-entity-broadcast-range-percentage").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-spawn-protection").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-max-world-size").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-max-players").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-query-port").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-rconport").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-max-tick-time").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-op-permission-level").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-function-permission-level").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-rate-limit").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-network-compression-threshold").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-view-distance").keypress(function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) {
            return false;
        } else {
            return true;
        }
    });

    $("#form-level-name").keypress(function(e) {
        if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 65 && e.keyCode <= 90 || e.keyCode >= 97 && e.keyCode <= 122 || e.keyCode == 45 || e.keyCode == 95 || e.keyCode == 13) {
            return true;
        } else {
            return false;
        }
    });

    document.getElementById("label-gamemode").innerHTML = "gamemode=" + document.getElementById("form-gamemode").value;
    document.getElementById("label-force-gamemode").innerHTML = "force-gamemode=" + document.getElementById("form-force-gamemode").value;
    document.getElementById("label-difficulty").innerHTML = "difficulty=" + document.getElementById("form-difficulty").value;
    document.getElementById("label-hardcore").innerHTML = "hardcore=" + document.getElementById("form-hardcore").value;
    document.getElementById("label-pvp").innerHTML = "pvp=" + document.getElementById("form-pvp").value;
    document.getElementById("label-spawn-npcs").innerHTML = "spawn-npcs=" + document.getElementById("form-spawn-npcs").value;
    document.getElementById("label-spawn-animals").innerHTML = "spawn-animals=" + document.getElementById("form-spawn-animals").value;
    document.getElementById("label-spawn-monsters").innerHTML = "spawn-monsters=" + document.getElementById("form-spawn-monsters").value;
    document.getElementById("label-allow-flight").innerHTML = "allow-flight=" + document.getElementById("form-allow-flight").value;
    document.getElementById("label-player-idle-timeout").innerHTML = "player-idle-timeout=" + document.getElementById("form-player-idle-timeout").value;
    document.getElementById("label-resource-pack").innerHTML = "resource-pack=" + document.getElementById("form-resource-pack").value;
    document.getElementById("label-resource-pack-sha1").innerHTML = "resource-pack-sha1=" + document.getElementById("form-resource-pack-sha1").value;
    document.getElementById("label-level-name").innerHTML = "level-name=" + document.getElementById("form-level-name").value;
    document.getElementById("label-level-seed").innerHTML = "level-seed=" + document.getElementById("form-level-seed").value;
    document.getElementById("label-level-type").innerHTML = "level-type=" + document.getElementById("form-level-type").value;
    document.getElementById("label-generator-settings").innerHTML = "generator-settings=" + document.getElementById("form-generator-settings").value;
    document.getElementById("label-max-build-height").innerHTML = "max-build-height=" + document.getElementById("form-max-build-height").value;
    document.getElementById("label-generate-structures").innerHTML = "generate-structures=" + document.getElementById("form-generate-structures").value;
    document.getElementById("label-allow-nether").innerHTML = "allow-nether=" + document.getElementById("form-allow-nether").value;
    document.getElementById("label-entity-broadcast-range-percentage").innerHTML = "entity-broadcast-range-percentage=" + document.getElementById("form-entity-broadcast-range-percentage").value;
    document.getElementById("label-spawn-protection").innerHTML = "spawn-protection=" + document.getElementById("form-spawn-protection").value;
    document.getElementById("label-max-world-size").innerHTML = "max-world-size=" + document.getElementById("form-max-world-size").value;
    document.getElementById("label-online-mode").innerHTML = "online-mode=" + document.getElementById("form-online-mode").value;
    document.getElementById("label-max-players").innerHTML = "max-players=" + document.getElementById("form-max-players").value;
    document.getElementById("label-enable-command-block").innerHTML = "enable-command-block=" + document.getElementById("form-enable-command-block").value;
    document.getElementById("label-enable-query").innerHTML = "enable-query=" + document.getElementById("form-enable-query").value;
    document.getElementById("label-query-port").innerHTML = "query.port=" + document.getElementById("form-query-port").value;
    document.getElementById("label-enable-rcon").innerHTML = "enable-rcon=" + document.getElementById("form-enable-rcon").value;
    document.getElementById("label-rconport").innerHTML = "rcon.port=" + document.getElementById("form-rconport").value;
    document.getElementById("label-rcon-password").innerHTML = "rcon.password=" + document.getElementById("form-rcon-password").value;
    document.getElementById("label-white-list").innerHTML = "white-list=" + document.getElementById("form-white-list").value;
    document.getElementById("label-enforce-whitelist").innerHTML = "enforce-whitelist=" + document.getElementById("form-enforce-whitelist").value;
    document.getElementById("label-server-ip").innerHTML = "server-ip=" + document.getElementById("form-server-ip").value;
    document.getElementById("label-enable-status").innerHTML = "enable-status=" + document.getElementById("form-enable-status").value;
    document.getElementById("label-broadcast-console-to-ops").innerHTML = "broadcast-console-to-ops=" + document.getElementById("form-broadcast-console-to-ops").value;
    document.getElementById("label-broadcast-rcon-to-ops").innerHTML = "broadcast-rcon-to-ops=" + document.getElementById("form-broadcast-rcon-to-ops").value;
    document.getElementById("label-use-native-transport").innerHTML = "use-native-transport=" + document.getElementById("form-use-native-transport").value;
    document.getElementById("label-prevent-proxy-connections").innerHTML = "prevent-proxy-connections=" + document.getElementById("form-prevent-proxy-connections").value;
    document.getElementById("label-enable-jmx-monitoring").innerHTML = "enable-jmx-monitoring=" + document.getElementById("form-enable-jmx-monitoring").value;
    document.getElementById("label-snooper-enabled").innerHTML = "snooper-enabled=" + document.getElementById("form-snooper-enabled").value;
    document.getElementById("label-sync-chunk-writes").innerHTML = "sync-chunk-writes=" + document.getElementById("form-sync-chunk-writes").value;
    document.getElementById("label-max-tick-time").innerHTML = "max-tick-time=" + document.getElementById("form-max-tick-time").value;
    document.getElementById("label-op-permission-level").innerHTML = "op-permission-level=" + document.getElementById("form-op-permission-level").value;
    document.getElementById("label-function-permission-level").innerHTML = "function-permission-level=" + document.getElementById("form-function-permission-level").value;
    document.getElementById("label-rate-limit").innerHTML = "rate-limit=" + document.getElementById("form-rate-limit").value;
    document.getElementById("label-network-compression-threshold").innerHTML = "network-compression-threshold=" + document.getElementById("form-network-compression-threshold").value;
    document.getElementById("label-view-distance").innerHTML = "view-distance=" + document.getElementById("form-view-distance").value;
    document.getElementById("label-motd").innerHTML = "motd=" + document.getElementById("form-motd").value;

    $("#form-gamemode").change(function() {
        $envioaction = "gamemode";
        $enviovalor = document.getElementById("form-gamemode").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-gamemode").innerHTML = "gamemode=" + document.getElementById("form-gamemode").value;
    });

    $("#form-force-gamemode").change(function() {
        $envioaction = "force-gamemode";
        $enviovalor = document.getElementById("form-force-gamemode").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-force-gamemode").innerHTML = "force-gamemode=" + document.getElementById("form-force-gamemode").value;
    });

    $("#form-difficulty").change(function() {
        $envioaction = "difficulty";
        $enviovalor = document.getElementById("form-difficulty").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-difficulty").innerHTML = "difficulty=" + document.getElementById("form-difficulty").value;
    });

    $("#form-hardcore").change(function() {
        $envioaction = "hardcore";
        $enviovalor = document.getElementById("form-hardcore").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-hardcore").innerHTML = "hardcore=" + document.getElementById("form-hardcore").value;
    });

    $("#form-pvp").change(function() {
        $envioaction = "pvp";
        $enviovalor = document.getElementById("form-pvp").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-pvp").innerHTML = "pvp=" + document.getElementById("form-pvp").value;
    });

    $("#form-spawn-npcs").change(function() {
        $envioaction = "spawn-npcs";
        $enviovalor = document.getElementById("form-spawn-npcs").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-spawn-npcs").innerHTML = "spawn-npcs=" + document.getElementById("form-spawn-npcs").value;
    });

    $("#form-spawn-animals").change(function() {
        $envioaction = "spawn-animals";
        $enviovalor = document.getElementById("form-spawn-animals").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-spawn-animals").innerHTML = "spawn-animals=" + document.getElementById("form-spawn-animals").value;
    });

    $("#form-spawn-monsters").change(function() {
        $envioaction = "spawn-monsters";
        $enviovalor = document.getElementById("form-spawn-monsters").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-spawn-monsters").innerHTML = "spawn-monsters=" + document.getElementById("form-spawn-monsters").value;
    });

    $("#form-allow-flight").change(function() {
        $envioaction = "allow-flight";
        $enviovalor = document.getElementById("form-allow-flight").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-allow-flight").innerHTML = "allow-flight=" + document.getElementById("form-allow-flight").value;
    });

    $("#form-player-idle-timeout").change(function() {
        $errores = 0;
        $envioaction = "player-idle-timeout";
        $enviovalor = document.getElementById("form-player-idle-timeout").value;
        if ($enviovalor > 2147483647) {
            $errores = 1;
        }

        if ($errores == 0) {
            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-player-idle-timeout").innerHTML = "player-idle-timeout=" + document.getElementById("form-player-idle-timeout").value;
        }
    });

    $("#form-resource-pack").keyup(function() {
        $envioaction = "resource-pack";
        $enviovalor = document.getElementById("form-resource-pack").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-resource-pack").innerHTML = "resource-pack=" + document.getElementById("form-resource-pack").value;
    });

    $("#form-resource-pack-sha1").keyup(function() {
        $envioaction = "resource-pack-sha1";
        $enviovalor = document.getElementById("form-resource-pack-sha1").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-resource-pack-sha1").innerHTML = "resource-pack-sha1=" + document.getElementById("form-resource-pack-sha1").value;
    });

    $("#form-level-name").keyup(function() {
        $envioaction = "level-name";
        $enviovalor = document.getElementById("form-level-name").value;
        $enviovalor = $enviovalor.toLowerCase();
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-level-name").innerHTML = "level-name=" + $enviovalor;
    });

    $("#form-level-seed").keyup(function() {
        $envioaction = "level-seed";
        $enviovalor = document.getElementById("form-level-seed").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-level-seed").innerHTML = "level-seed=" + document.getElementById("form-level-seed").value;
    });

    $("#form-level-type").change(function() {
        $envioaction = "level-type";
        $enviovalor = document.getElementById("form-level-type").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-level-type").innerHTML = "level-type=" + document.getElementById("form-level-type").value;
    });

    $("#form-generator-settings").keyup(function() {
        $envioaction = "generator-settings";
        $enviovalor = document.getElementById("form-generator-settings").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-generator-settings").innerHTML = "generator-settings=" + document.getElementById("form-generator-settings").value;
    });

    $("#form-max-build-height").change(function() {
        $errores = 0;
        $envioaction = "max-build-height";
        $enviovalor = document.getElementById("form-max-build-height").value;
        if ($enviovalor > 256 || $enviovalor < 8) {
            $errores = 1;
        }

        if ($errores == 0) {
            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-max-build-height").innerHTML = "max-build-height=" + document.getElementById("form-max-build-height").value;
        }
    });

    $("#form-generate-structures").change(function() {
        $envioaction = "generate-structures";
        $enviovalor = document.getElementById("form-generate-structures").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-generate-structures").innerHTML = "generate-structures=" + document.getElementById("form-generate-structures").value;
    });

    $("#form-allow-nether").change(function() {
        $envioaction = "allow-nether";
        $enviovalor = document.getElementById("form-allow-nether").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-allow-nether").innerHTML = "allow-nether=" + document.getElementById("form-allow-nether").value;
    });

    $("#form-entity-broadcast-range-percentage").change(function() {
        $errores = 0;
        $envioaction = "entity-broadcast-range-percentage";
        $enviovalor = document.getElementById("form-entity-broadcast-range-percentage").value;

        if ($enviovalor > 500 || $enviovalor < 0) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-entity-broadcast-range-percentage").innerHTML = "entity-broadcast-range-percentage=" + document.getElementById("form-entity-broadcast-range-percentage").value;
        }
    });

    $("#form-spawn-protection").change(function() {
        $errores = 0;
        $envioaction = "spawn-protection";
        $enviovalor = document.getElementById("form-spawn-protection").value;

        if ($enviovalor > 16 || $enviovalor < 0) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-spawn-protection").innerHTML = "spawn-protection=" + document.getElementById("form-spawn-protection").value;
        }
    });

    $("#form-max-world-size").change(function() {
        $errores = 0;
        $envioaction = "max-world-size";
        $enviovalor = document.getElementById("form-max-world-size").value;

        if ($enviovalor > 29999984 || $enviovalor < 1) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-max-world-size").innerHTML = "max-world-size=" + document.getElementById("form-max-world-size").value;
        }
    });

    $("#form-online-mode").change(function() {
        $envioaction = "online-mode";
        $enviovalor = document.getElementById("form-online-mode").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-online-mode").innerHTML = "online-mode=" + document.getElementById("form-online-mode").value;
    });

    $("#form-max-players").change(function() {
        $errores = 0;
        $envioaction = "max-players";
        $enviovalor = document.getElementById("form-max-players").value;

        if ($enviovalor > 2147483647 || $enviovalor < 1) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-max-players").innerHTML = "max-players=" + document.getElementById("form-max-players").value;
        }
    });

    $("#form-enable-command-block").change(function() {
        $envioaction = "enable-command-block";
        $enviovalor = document.getElementById("form-enable-command-block").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-enable-command-block").innerHTML = "enable-command-block=" + document.getElementById("form-enable-command-block").value;
    });

    $("#form-enable-query").change(function() {
        $envioaction = "enable-query";
        $enviovalor = document.getElementById("form-enable-query").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-enable-query").innerHTML = "enable-query=" + document.getElementById("form-enable-query").value;
    });

    $("#form-query-port").change(function() {
        $errores = 0;
        $envioaction = "query.port";
        $enviovalor = document.getElementById("form-query-port").value;

        if ($enviovalor > 65535 || $enviovalor < 1025) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-query-port").innerHTML = "query.port=" + document.getElementById("form-query-port").value;
        }
    });

    $("#form-enable-rcon").change(function() {
        $envioaction = "enable-rcon";
        $enviovalor = document.getElementById("form-enable-rcon").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-enable-rcon").innerHTML = "enable-rcon=" + document.getElementById("form-enable-rcon").value;
    });

    $("#form-rconport").change(function() {
        $errores = 0;
        $envioaction = "rcon.port";
        $enviovalor = document.getElementById("form-rconport").value;

        if ($enviovalor > 65535 || $enviovalor < 1025) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-rconport").innerHTML = "rcon.port=" + document.getElementById("form-rconport").value;
        }
    });

    $("#form-rcon-password").keyup(function() {
        $envioaction = "rcon.password";
        $enviovalor = document.getElementById("form-rcon-password").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-rcon-password").innerHTML = "rcon.password=" + document.getElementById("form-rcon-password").value;
    });

    $("#form-white-list").change(function() {
        $envioaction = "white-list";
        $enviovalor = document.getElementById("form-white-list").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-white-list").innerHTML = "white-list=" + document.getElementById("form-white-list").value;
    });

    $("#form-enforce-whitelist").change(function() {
        $envioaction = "enforce-whitelist";
        $enviovalor = document.getElementById("form-enforce-whitelist").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-enforce-whitelist").innerHTML = "enforce-whitelist=" + document.getElementById("form-enforce-whitelist").value;
    });

    $("#form-server-ip").keyup(function() {
        $envioaction = "server-ip";
        $enviovalor = document.getElementById("form-server-ip").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-server-ip").innerHTML = "server-ip=" + document.getElementById("form-server-ip").value;
    });

    $("#form-enable-status").change(function() {
        $envioaction = "enable-status";
        $enviovalor = document.getElementById("form-enable-status").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-enable-status").innerHTML = "enable-status=" + document.getElementById("form-enable-status").value;
    });

    $("#form-broadcast-console-to-ops").change(function() {
        $envioaction = "broadcast-console-to-ops";
        $enviovalor = document.getElementById("form-broadcast-console-to-ops").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-broadcast-console-to-ops").innerHTML = "broadcast-console-to-ops=" + document.getElementById("form-broadcast-console-to-ops").value;
    });

    $("#form-broadcast-rcon-to-ops").change(function() {
        $envioaction = "broadcast-rcon-to-ops";
        $enviovalor = document.getElementById("form-broadcast-rcon-to-ops").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-broadcast-rcon-to-ops").innerHTML = "broadcast-rcon-to-ops=" + document.getElementById("form-broadcast-rcon-to-ops").value;
    });

    $("#form-use-native-transport").change(function() {
        $envioaction = "use-native-transport";
        $enviovalor = document.getElementById("form-use-native-transport").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-use-native-transport").innerHTML = "use-native-transport=" + document.getElementById("form-use-native-transport").value;
    });

    $("#form-prevent-proxy-connections").change(function() {
        $envioaction = "prevent-proxy-connections";
        $enviovalor = document.getElementById("form-prevent-proxy-connections").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-prevent-proxy-connections").innerHTML = "prevent-proxy-connections=" + document.getElementById("form-prevent-proxy-connections").value;
    });

    $("#form-enable-jmx-monitoring").change(function() {
        $envioaction = "enable-jmx-monitoring";
        $enviovalor = document.getElementById("form-enable-jmx-monitoring").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-enable-jmx-monitoring").innerHTML = "enable-jmx-monitoring=" + document.getElementById("form-enable-jmx-monitoring").value;
    });

    $("#form-snooper-enabled").change(function() {
        $envioaction = "snooper-enabled";
        $enviovalor = document.getElementById("form-snooper-enabled").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-snooper-enabled").innerHTML = "snooper-enabled=" + document.getElementById("form-snooper-enabled").value;
    });

    $("#form-sync-chunk-writes").change(function() {
        $envioaction = "sync-chunk-writes";
        $enviovalor = document.getElementById("form-sync-chunk-writes").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-sync-chunk-writes").innerHTML = "sync-chunk-writes=" + document.getElementById("form-sync-chunk-writes").value;
    });

    $("#form-max-tick-time").change(function() {
        $errores = 0;
        $envioaction = "max-tick-time";
        $enviovalor = document.getElementById("form-max-tick-time").value;

        if ($enviovalor > 60000 || $enviovalor < 1000) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-max-tick-time").innerHTML = "max-tick-time=" + document.getElementById("form-max-tick-time").value;
        }
    });

    $("#form-op-permission-level").change(function() {
        $errores = 0;
        $envioaction = "op-permission-level";
        $enviovalor = document.getElementById("form-op-permission-level").value;

        if ($enviovalor > 4 || $enviovalor < 1) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-op-permission-level").innerHTML = "op-permission-level=" + document.getElementById("form-op-permission-level").value;
        }
    });

    $("#form-function-permission-level").change(function() {
        $errores = 0;
        $envioaction = "function-permission-level";
        $enviovalor = document.getElementById("form-function-permission-level").value;

        if ($enviovalor > 4 || $enviovalor < 1) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-function-permission-level").innerHTML = "function-permission-level=" + document.getElementById("form-function-permission-level").value;
        }
    });

    $("#form-rate-limit").change(function() {
        $envioaction = "rate-limit";
        $enviovalor = document.getElementById("form-rate-limit").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-rate-limit").innerHTML = "rate-limit=" + document.getElementById("form-rate-limit").value;
    });

    $("#form-network-compression-threshold").change(function() {
        $errores = 0;
        $envioaction = "network-compression-threshold";
        $enviovalor = document.getElementById("form-network-compression-threshold").value;

        if ($enviovalor > 256 || $enviovalor < 64) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-network-compression-threshold").innerHTML = "network-compression-threshold=" + document.getElementById("form-network-compression-threshold").value;
        }
    });

    $("#form-view-distance").change(function() {
        $errores = 0;
        $envioaction = "view-distance";
        $enviovalor = document.getElementById("form-view-distance").value;

        if ($enviovalor > 32 || $enviovalor < 3) {
            $errores = 1;
        }

        if ($errores == 0) {

            $.ajax({
                type: "POST",
                url: "function/guardarproperties.php",
                data: {
                    action: $envioaction,
                    valor: $enviovalor
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                }
            });
            document.getElementById("label-view-distance").innerHTML = "view-distance=" + document.getElementById("form-view-distance").value;
        }
    });

    function updatemotd(textomotd) {
        $.ajax({
            type: "POST",
            url: "function/visormotd.php",
            data: {
                action: textomotd
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }

                document.getElementById("visormotd").innerHTML = data;
            }
        });
    }

    $("#form-motd").keyup(function(e) {
        $envioaction = "motd";
        $enviovalor = document.getElementById("form-motd").value;
        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-motd").innerHTML = "motd=" + document.getElementById("form-motd").value;
        updatemotd(document.getElementById("form-motd").value);
    });

    document.getElementById("form-motd").addEventListener('paste', function(event) {
        $envioaction = "motd";
        $enviovalor = event.clipboardData.getData('text');

        var eltext = "";
        var textini = "";
        var textfinal = "";
        var enviar = "";

        var text = document.getElementById("form-motd");

        var startPosition = text.selectionStart;
        var endPosition = text.selectionEnd;
        var longitud = text.leng;

        var eltext = document.getElementById("form-motd").value;
        var textini = eltext.substring(0, startPosition);
        var textfinal = eltext.substring(endPosition, longitud);

        var enviar = textini + event.clipboardData.getData('text') + textfinal;
        $enviovalor = enviar;

        $.ajax({
            type: "POST",
            url: "function/guardarproperties.php",
            data: {
                action: $envioaction,
                valor: $enviovalor
            },
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
            }
        });
        document.getElementById("label-motd").innerHTML = "motd=" + $enviovalor;
        updatemotd($enviovalor);
    });

    var mySessionTimer = setInterval(sessionTimer, 1000);

    function sessionTimer() {

        var tqxhr = $.ajax({
            url: 'function/salirsession.php',
            data: {
                action: 'status'
            },
            type: 'POST',
            success: function(data) {
                if (data == "SALIR") {
                    location.href = "index.php";
                }


            }
        });
    }

});