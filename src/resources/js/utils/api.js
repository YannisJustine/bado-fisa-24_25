export default class API {

    static getBaseUrl() {
        const apiUrl = `${new URL(window.location.href).origin}/api`;
        return apiUrl;
    }

    static getCsrfToken() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        return csrfToken;
    }

    static async fetchResource(endpoint, params = '', method = 'GET', body = null) {
        const request = {
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-Token': API.getCsrfToken()
            },
            method: method,
            body: body,
        }
        const response = await fetch(`${API.getBaseUrl()}/${endpoint}?${params}`, request);
        return response
    }

    static async getCandidats() {
        const data = await API.fetchResource(`candidats`);
        return data.json();
    }

    static async getFormateurs() {
        const data = await API.fetchResource(`formateurs`);
        return data.json();
    }

    static async getCreneaux() {
        const data = await API.fetchResource(`creneaux`);
        return data.json();
    }

    static async getUserCreneaux(user) {
        const data = await API.fetchResource(`formateurs/${user}/events`);
        return data.json();
    }

    static async getEvents(args = "") {
        const data = await API.fetchResource(`events`, args);
        return data.json();
    }

    static async getUserEvents(user, args = "") {
        const data = await API.fetchResource(`events/users/${user}`, args);
        return data.json();
    }

    static async getFormules() {
        const data = await API.fetchResource(`formules`);
        return data.json();
    }

    static async getTypePermis() {
        const data = await API.fetchResource(`type_permis`);
        return data.json();
    }

    static async postEvent(event) {
        const data = await API.fetchResource(`events`, '', 'POST', event);
        return data;
    }

    static async deleteEvent(id) {
        const data = await API.fetchResource(`events/${id}`, '', 'DELETE');
        return data;
    }

    static async updateEvent(id, event) {
        const data = await API.fetchResource(`events/${id}`, '', 'PUT', event);
        return data;
    }

    static async fetchOnline(endpoint, params = {}) {
        const response = await fetch(`${endpoint}?${params}`);
        if (!response.ok) {
            throw new Error(`API error (${response.status})`);
        }
        const data = await response.json();
        return data;
    }
}

