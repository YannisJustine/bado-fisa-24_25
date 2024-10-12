<template>
    <div class="wrapper">
        <div class="kirby-leafleat-map">
            <div :class="classStyle" id="map"></div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import API from '../../utils/api.js'
import '@/leaflet/dist/leaflet.css'
import icon from '@/leaflet/dist/images/marker-icon.png'
import L from 'leaflet'

const props = defineProps({
    address: String,
    classStyle: String
})

onMounted(async () => {
    const coordinatesResponse = await API.fetchOnline("https://api-adresse.data.gouv.fr/search/", `q=${props.address}&limit=1`);
    const coordinates = (coordinatesResponse.features[0]?.geometry.coordinates) || [2.3522, 48.8566];

    var map = L.map('map').setView(coordinates.reverse(), 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 5,
        maxZoom: 15,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    const myIcon = L.icon({
        iconUrl: icon,
        iconSize: [25, 41], // size of the icon
        shadowSize: [50, 64], // size of the shadow
        iconAnchor: [12, 41], // point of the icon which will correspond to marker's location
        shadowAnchor: [12, 41],  // the same for the shadow
        popupAnchor: [0, -40] // point from which the popup should open relative to the iconAnchor
    });
    L.marker(coordinates, { icon: myIcon }).addTo(map).bindPopup(props.address).openPopup();

})

</script>

<style>
.wrapper {
    width: 100%;
    position: relative;
}

.kirby-leafleat-map {
    width: 100%;
    height: 0;
    padding-bottom: 56.25%;
    /* this gives you a 16/9 ratio**/
    position: relative;
}

#map {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    z-index: 5;
}
</style>