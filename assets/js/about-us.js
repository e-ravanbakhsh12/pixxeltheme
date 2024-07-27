(function ($) {
  "use strict";
  class ContactUsOperations {
    constructor() {
      let _this = this;

      this.displayMapLocation();

    }

    displayMapLocation() {
      const _this = this;
      const mapContainer = $(".pixxel-map");
      const lat = parseFloat(mapContainer.data("lat"));
      const lng = parseFloat(mapContainer.data("lng"));
      const map = L.map("pixxel-map", { zoomControl: false }).setView(
        [lat, lng],
        14
      );
      L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "",
      }).addTo(map);

      $(".leaflet-control-attribution.leaflet-control").addClass("hidden");
      const zoom = 15;

      const centralLocation = L.divIcon({
        className: "my-div-icon",
        html: `
            <img src="${pixxelArr.templateUri}/assets/img/marker.png" class="pixxel-marker !w-9 !h-10 object-contain"  Lat="${lat}" Lng="${lng}">
      `,
        iconSize: [54, 61],
        iconAnchor: [27, 57],
      });
      L.marker([lat, lng]).addTo(map);

      map.on("zoomend", function (e) {
        zoom = e.target.getZoom();
      });
      map.on("dragend", function (e) {});

      _this.getCurrentLocation(map, mapContainer);
    }

    getCurrentLocation(map, mapContainer) {
      let _this = this;
      let currentMarker;
      window.navigator.geolocation.getCurrentPosition(function (e) {
        let userLocation = L.divIcon({
          className: "my-div-icon",
          html: `
      <div class="pixxel-current-marker" Lat="${e.coords.latitude}" Lng="${e.coords.longitude}">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path opacity="0.3" d="M40 20C40 31.0457 31.0457 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20Z" fill="#61A2FF"/>
          <path d="M25.9961 20C25.9961 23.3137 23.3098 26 19.9961 26C16.6824 26 13.9961 23.3137 13.9961 20C13.9961 16.6863 16.6824 14 19.9961 14C23.3098 14 25.9961 16.6863 25.9961 20Z" fill="#61A2FF"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M27.6654 20.0007C27.6654 24.2348 24.2329 27.6673 19.9987 27.6673C15.7645 27.6673 12.332 24.2348 12.332 20.0007C12.332 15.7665 15.7645 12.334 19.9987 12.334C24.2329 12.334 27.6654 15.7665 27.6654 20.0007ZM19.9987 26.0007C23.3124 26.0007 25.9987 23.3144 25.9987 20.0007C25.9987 16.6869 23.3124 14.0007 19.9987 14.0007C16.685 14.0007 13.9987 16.6869 13.9987 20.0007C13.9987 23.3144 16.685 26.0007 19.9987 26.0007Z" fill="white"/>
        </svg>
      </div>
        `,
          iconSize: [40, 40],
          iconAnchor: [20, 20],
        });

        currentMarker = L.marker([e.coords.latitude, e.coords.longitude], {
          icon: userLocation,
        }).addTo(map);
        let currentLocation = mapContainer.find(".pixxelicon-current-location");
        currentLocation.removeClass("hidden");
      });
    }
  }
  const contactUs = new ContactUsOperations();
})(jQuery);
