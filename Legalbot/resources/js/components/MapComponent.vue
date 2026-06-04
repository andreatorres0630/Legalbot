<template>
  <div class="grid gap-6 lg:grid-cols-[1.6fr_1fr]">
    <div class="relative min-h-[520px] overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
      <div ref="mapContainer" class="h-full w-full"></div>

      <div v-if="isLoading" class="absolute inset-0 z-10 flex items-center justify-center bg-white/80 text-slate-700 font-semibold">
        Cargando mapa...
      </div>
    </div>

    <aside class="max-h-[520px] overflow-y-auto rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
      <header class="mb-6 rounded-3xl bg-purple-50 p-5">
        <h2 class="text-lg font-semibold text-slate-900">Instituciones legales</h2>
        <p class="mt-2 text-sm leading-6 text-slate-600">Ordenadas de la más cercana a la más lejana. Haz clic en “Ver” para ubicarla en el mapa.</p>
      </header>

      <div class="space-y-5">
        <article v-for="location in sortedLocations" :key="location.title" class="rounded-[26px] border border-slate-200 bg-slate-50 p-5 shadow-sm">
          <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
              <h3 class="text-sm font-semibold text-slate-900">{{ location.title }}</h3>
              <p class="mt-2 text-xs leading-5 text-slate-600">{{ location.description }}</p>
            </div>
            <button @click="focusLocation(location)" class="rounded-2xl bg-purple-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-purple-700">Ver</button>
          </div>
          <div class="mt-4 space-y-2 text-xs text-slate-600">
            <p><span class="font-semibold text-slate-800">Distancia:</span> <span class="text-purple-700">{{ formatDistance(location.distanceKm) }}</span></p>
            <p><span class="font-semibold text-slate-800">Dirección:</span> {{ location.address }}</p>
            <p><span class="font-semibold text-slate-800">Contacto:</span> {{ location.phone }}</p>
            <p><span class="font-semibold text-slate-800">Horario:</span> {{ location.hours }}</p>
            <p v-if="location.withinRadius" class="mt-2 inline-flex rounded-full bg-emerald-100 px-3 py-1 text-emerald-700">Dentro del radio de {{ nearbyRadiusKm }} km</p>
          </div>
        </article>
      </div>

      <p v-if="!userLocation" class="mt-6 text-sm leading-6 text-slate-500">Activa la ubicación en tu navegador para calcular distancias y ordenar las sedes de la más cercana a la más lejana.</p>
    </aside>
  </div>
</template>

<script>
import { setOptions, importLibrary } from '@googlemaps/js-api-loader';

export default {
  name: 'MapComponent',
  props: {
    lat: { type: Number, default: 13.6929 },  // El Salvador por defecto
    lng: { type: Number, default: -89.2182 },
    zoom: { type: Number, default: 12 }
  },
  data() {
    return {
      map: null,
      marker: null,
      institutionMarkers: [],
      infoWindow: null,
      errorMessage: null,
      isLoading: true,
      userLocation: null,
      nearbyRadiusKm: 25,
      locations: [
        {
          title: 'Corte Suprema de Justicia',
          description: 'Poder Judicial de El Salvador',
          position: { lat: 13.7133, lng: -89.2100 },
          address: 'San Salvador',
          phone: '+503 2510 2660',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Tribunal Supremo Electoral',
          description: 'Órgano rector de los procesos electorales',
          position: { lat: 13.7167, lng: -89.1991 },
          address: 'San Salvador',
          phone: '+503 2521 6400',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Fiscalía General de la República',
          description: 'Investigación y persecución de delitos',
          position: { lat: 13.7123, lng: -89.2209 },
          address: 'Col. Miramonte, San Salvador',
          phone: '+503 2233 8200',
          hours: 'Lun-Vie 08:00-17:00'
        },
        {
          title: 'Ministerio de Justicia y Seguridad Pública',
          description: 'Administración del sistema penitenciario y seguridad',
          position: { lat: 13.6944, lng: -89.2132 },
          address: 'San Salvador',
          phone: '+503 2527 8200',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Procuraduría para la Defensa de los Derechos Humanos',
          description: 'Protección de los derechos humanos en El Salvador',
          position: { lat: 13.7039, lng: -89.2090 },
          address: 'San Salvador',
          phone: '+503 2224 4400',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Consejo Nacional de la Judicatura',
          description: 'Supervisión disciplinaria del Poder Judicial',
          position: { lat: 13.7125, lng: -89.1997 },
          address: 'San Salvador',
          phone: '+503 2524 4400',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Registro Nacional de las Personas Naturales',
          description: 'Registro civil y documentación de identidad',
          position: { lat: 13.7137, lng: -89.2141 },
          address: 'San Salvador',
          phone: '+503 2258 4400',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'PNC Delegación Santa Ana',
          description: 'Policía Nacional Civil en el occidente del país',
          position: { lat: 13.9942, lng: -89.5592 },
          address: 'Santa Ana',
          phone: '+503 2441 6200',
          hours: '24 horas'
        },
        {
          title: 'Tribunal de Sentencia de Santa Ana',
          description: 'Administración de justicia penal en Santa Ana',
          position: { lat: 13.9891, lng: -89.5668 },
          address: 'Santa Ana',
          phone: '+503 2441 7300',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Fiscalía Regional de San Miguel',
          description: 'Fiscalía para la zona oriental del país',
          position: { lat: 13.4837, lng: -88.1793 },
          address: 'San Miguel',
          phone: '+503 2666 0100',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Juzgado de Primera Instancia de Sonsonate',
          description: 'Justicia local en el departamento de Sonsonate',
          position: { lat: 13.7202, lng: -89.7248 },
          address: 'Sonsonate',
          phone: '+503 2442 7800',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Centro Judicial de San Vicente',
          description: 'Servicios judiciales del departamento de San Vicente',
          position: { lat: 13.7244, lng: -88.8100 },
          address: 'San Vicente',
          phone: '+503 2390 2000',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Fiscalía Regional de Usulután',
          description: 'Persecución penal para la zona oriental',
          position: { lat: 13.3421, lng: -88.4497 },
          address: 'Usulután',
          phone: '+503 2664 0300',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Delegación PNC de La Unión',
          description: 'Policía Nacional Civil en la región oriental',
          position: { lat: 13.3393, lng: -87.8318 },
          address: 'La Unión',
          phone: '+503 2666 0900',
          hours: '24 horas'
        },
        {
          title: 'Defensoría Pública de La Libertad',
          description: 'Defensa jurídica gratuita en La Libertad',
          position: { lat: 13.6504, lng: -89.2351 },
          address: 'La Libertad',
          phone: '+503 2525 5600',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Oficina del Registro de la Propiedad de Ahuachapán',
          description: 'Registro de bienes inmuebles en Ahuachapán',
          position: { lat: 13.9203, lng: -89.8400 },
          address: 'Ahuachapán',
          phone: '+503 2443 6400',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'Fiscalía Regional de Chalatenango',
          description: 'Fiscalía para el norte del país',
          position: { lat: 14.0118, lng: -89.5316 },
          address: 'Chalatenango',
          phone: '+503 2393 0900',
          hours: 'Lun-Vie 08:00-16:30'
        },
        {
          title: 'PNC Delegación San Miguel',
          description: 'Policía Nacional Civil en El Salvador oriental',
          position: { lat: 13.4831, lng: -88.1804 },
          address: 'San Miguel',
          phone: '+503 2666 2200',
          hours: '24 horas'
        },
        {
          title: 'Tribunal de Primera Instancia de Ahuachapán',
          description: 'Servicio judicial en Ahuachapán',
          position: { lat: 13.9206, lng: -89.8441 },
          address: 'Ahuachapán',
          phone: '+503 2443 4100',
          hours: 'Lun-Vie 08:00-16:30'
        }
      ]
    };
  },
  async mounted() {
    await this.initMap();
    if (!this.errorMessage) {
      this.locateUser();
    }
  },
  computed: {
    sortedLocations() {
      const list = this.locations.map((location) => {
        const distanceKm = this.userLocation ? this.getDistanceKm(this.userLocation, location.position) : null;
        return {
          ...location,
          distanceKm,
          withinRadius: distanceKm !== null ? distanceKm <= this.nearbyRadiusKm : false
        };
      });

      if (this.userLocation) {
        return list.sort((a, b) => a.distanceKm - b.distanceKm);
      }

      return list;
    }
  },
  methods: {
    async initMap() {
      try {
        setOptions({
          key: import.meta.env.VITE_GOOGLE_MAPS_KEY,
          v: 'weekly',
          libraries: ['places'],
        });

        const { Map } = await importLibrary('maps');

        this.map = new Map(this.$refs.mapContainer, {
          center: { lat: this.lat, lng: this.lng },
          zoom: this.zoom,
        });

        this.marker = new google.maps.Marker({
          position: { lat: this.lat, lng: this.lng },
          map: this.map,
          title: 'Mi ubicación',
        });

        this.createInstitutionMarkers();

        this.map.addListener('click', (event) => {
          const { lat, lng } = event.latLng;
          this.$emit('map-click', { lat: lat(), lng: lng() });
          this.marker.setPosition(event.latLng);
        });
      } catch (error) {
        console.error('Error cargando Google Maps:', error);
        this.errorMessage = error.message || 'No se pudo inicializar el mapa.';
      } finally {
        this.isLoading = false;
      }
    },
    createInstitutionMarkers() {
      this.infoWindow = new google.maps.InfoWindow();

      this.locations.forEach((location) => {
        const marker = new google.maps.Marker({
          position: location.position,
          map: this.map,
          title: location.title,
        });

        marker.addListener('click', () => {
          this.openLocationInfo(location, marker);
        });

        location.marker = marker;
        this.institutionMarkers.push(marker);
      });
    },
    openLocationInfo(location, marker) {
      const distanceKm = this.userLocation ? this.getDistanceKm(this.userLocation, location.position) : null;
      const distanceText = distanceKm !== null ? `<div><strong>Distancia:</strong> ${this.formatDistance(distanceKm)}</div>` : '';
      const radiusText = distanceKm !== null && distanceKm <= this.nearbyRadiusKm ? `<div style="color:#047857; font-weight:700;">Dentro del radio de ${this.nearbyRadiusKm} km</div>` : '';

      this.infoWindow.setContent(`
        <div style="font-size:14px; line-height:1.45; color:#0F172A; max-width:260px;">
          <strong>${location.title}</strong>
          <div style="margin:6px 0 4px; color:#475569;">${location.description}</div>
          <div><strong>Dirección:</strong> ${location.address}</div>
          <div><strong>Contacto:</strong> ${location.phone}</div>
          <div><strong>Horario:</strong> ${location.hours}</div>
          ${distanceText}
          ${radiusText}
        </div>
      `);

      this.infoWindow.open(this.map, marker);
    },
    focusLocation(location) {
      if (!this.map) return;

      this.map.panTo(location.position);
      this.map.setZoom(12);

      if (location.marker) {
        this.openLocationInfo(location, location.marker);
      }
    },
    getDistanceKm(from, to) {
      const toRad = (value) => value * Math.PI / 180;
      const R = 6371;
      const dLat = toRad(to.lat - from.lat);
      const dLon = toRad(to.lng - from.lng);
      const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(toRad(from.lat)) * Math.cos(toRad(to.lat)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      return R * c;
    },
    formatDistance(distanceKm) {
      if (distanceKm === null || distanceKm === undefined) {
        return 'N/A';
      }
      return `${distanceKm.toFixed(1)} km`;
    },
    locateUser() {
      if (!navigator.geolocation) {
        console.warn('Geolocalización no soportada por el navegador.');
        return;
      }

      navigator.geolocation.getCurrentPosition(
        (position) => {
          const userLat = position.coords.latitude;
          const userLng = position.coords.longitude;
          const userPosition = { lat: userLat, lng: userLng };

          this.userLocation = userPosition;

          if (this.map) {
            this.map.setCenter(userPosition);
            this.map.setZoom(12);
          }

          if (this.marker) {
            this.marker.setPosition(userPosition);
          } else {
            this.marker = new google.maps.Marker({
              position: userPosition,
              map: this.map,
              title: 'Mi ubicación',
            });
          }

          this.$emit('user-location', userPosition);
        },
        (error) => {
          console.warn('No se pudo obtener la ubicación del usuario:', error.message);
        },
        { timeout: 10000 }
      );
    }
  }
};
</script>