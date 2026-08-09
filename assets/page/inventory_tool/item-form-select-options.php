<?php
$rooms = $fPlace !== null ? locChildren($db, $fPlace) : [];
$containers = $fRoom !== null ? locChildren($db, $fRoom) : [];
$bagContainers = $fBagTop !== null ? bagChildren($db, $fBagTop) : [];
