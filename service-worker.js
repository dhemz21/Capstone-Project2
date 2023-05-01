var CACHE_NAME = 'evsu_system_v1';
var urlsToCache = [
  '/',
  '/index.php',
  'include/head.php',
  'js/scanner.js',
  'css/style.css',
  'img/evsu.png',
  'img/mainpage.jpg',
  'pages/menu.php',
  'pages/offline.php',
  'pages/school_event.php',
  'dist/css/bootstrap.css',
  'dist/css/bootstrap.min.css',
  'vendors/fontawesome-free/css/all.min.css',
  'dist/sweetalert2/sweetalert2.all.min.js',
  'vendors/jquery/jquery.min.js',
  'vendors/jquery/jquery.slim.min.js',
  'vendors/instascan/instascan.min.js'

];

self.addEventListener('install', function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Cache hit - return response
        if (response) {
          return response;
        }
        return fetch(event.request);
      }
    )
  );
});

self.addEventListener('activate', function(event) {
  var cacheWhitelist = ['evsu_system_v1'];
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});