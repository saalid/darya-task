<template>
    <div>
        <form @submit.prevent="submit">
            <input type="text" v-model="latitude" placeholder="Latitude" />
            <input type="text" v-model="longitude" placeholder="Longitude" />
            <button type="submit">Submit</button>
        </form>

        <div v-if="loading">Loading...</div>
        <div v-else-if="weather">
            <h3>Weather Data</h3>
            <p>High: {{ weather.high }}°</p>
            <p>Low: {{ weather.low }}°</p>
            <p>Weather: {{ weather.weather }}</p>
            <p>Sunrise: {{ weather.sunrise }}</p>
            <p>Sunset: {{ weather.sunset }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const latitude = ref('')
const longitude = ref('')
const loading = ref(false)
const weather = ref(null)

const submit = async () => {
    loading.value = true
    await axios.post('/api/weather-request', { latitude: latitude.value, longitude: longitude.value })

    const interval = setInterval(async () => {
        const { data } = await axios.get('/api/weather-data')
        if (data && data.latitude === parseFloat(latitude.value)) {
            weather.value = data
            loading.value = false
            clearInterval(interval)
        }
    }, 2000)
}
</script>
