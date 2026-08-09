<?php
// STUB until real login is built. Session is already started in db.php.
//
// Every query that touches per-user data (items, owners, bags, locations,
// categories) calls currentUserId() rather than reading $_SESSION or a URL
// parameter directly. That's deliberate: it means wiring up real login later
// is a one-line change right here (set $_SESSION['user_id'] on successful
// auth, then drop the "?? 1" fallback below) instead of re-auditing every
// query in the app.
//
// The fallback to user 1 keeps the app working as a single-user tool until
// login exists. Once login is in place, this should almost certainly become
// something that redirects to a login page if no session user is set, rather
// than silently defaulting to a specific account.
function currentUserId(): int {
	return (int)($_SESSION['user_id'] ?? 1);
}
