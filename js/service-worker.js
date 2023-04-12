self.addEventListener('install', function(event) {
  caches.open('evsu_cache').then(function(cache) {
    return cache.addAll([
      'index.php',
      'include/head.php',
      'assets/style.css',
      'img/evsu.png',
      // Add other files you want to cache here
    ]);
  }).catch(function(error) {
    console.error('Cache error:', error);
  });
  
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request).catch(function() {
        console.log('Network request failed:', event.request.url);
      });
    })
  );
});
