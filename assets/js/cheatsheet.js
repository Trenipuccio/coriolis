/**
 * Coriolis: The Great Dark — Cheatsheet
 * cheatsheet.js — Tab navigation logic
 * Nota: la lingua è gestita server-side via ?lang= (PHP)
 */

function showTab(id) {
  document.querySelectorAll('.tab-content').forEach(function(t) {
    t.classList.remove('active');
  });
  document.querySelectorAll('.tab-btn').forEach(function(b) {
    b.classList.remove('active');
  });
  document.getElementById('tab-' + id).classList.add('active');
  event.currentTarget.classList.add('active');
}
