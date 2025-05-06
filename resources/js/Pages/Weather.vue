
<template>
    <div>
        <form @submit.prevent="submit">
            <TextInput v-model="latitude" placeholder="Latitude" />
            <TextInput v-model="longitude" placeholder="Longitude" />
            <button type="submit" :disabled="loading">Submit</button>
            <div v-if="error" class="text-red-500">{{ error }}</div>
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
import { ref } from 'vue'
import axios from 'axios'
import TextInput from '../Components/TextInput.vue'

const latitude = ref('')
const longitude = ref('')
const loading = ref(false)
const weather = ref(null)
const error = ref('')

const validate = () => {
    if (!latitude.value || !longitude.value) {
        error.value = 'Both latitude and longitude are required.'
        return false
    }
    const lat = parseFloat(latitude.value)
    const lon = parseFloat(longitude.value)
    if (isNaN(lat) || isNaN(lon)) {
        error.value = 'Latitude and longitude must be numbers.'
        return false
    }
    if (lat < -90 || lat > 90 || lon < -180 || lon > 180) {
        error.value = 'Latitude must be between -90 and 90, longitude between -180 and 180.'
        return false
    }
    error.value = ''
    return true
}

const submit = async () => {
    if (!validate()) return
    loading.value = true
    error.value = ''
    try {
        await axios.post('/api/weather-request', { latitude: latitude.value, longitude: longitude.value })
        const interval = setInterval(async () => {
            try {
                const { data } = await axios.get('/api/weather-data')
                if (data && data.latitude === parseFloat(latitude.value)) {
                    weather.value = data
                    loading.value = false
                    clearInterval(interval)
                }
            } catch (e) {
                error.value = 'Failed to fetch weather data.'
                loading.value = false
                clearInterval(interval)
            }
        }, 2000)
    } catch (e) {
        error.value = 'Failed to submit request.'
        loading.value = false
    }
}
</script>
