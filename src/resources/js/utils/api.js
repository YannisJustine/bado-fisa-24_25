export default class API {

    static getBaseUrl() {
        var apiUrl = new URL(window.location.href).origin;
        apiUrl += '/api';
        return apiUrl;
    }

    static async fetchResource(endpoint, params = '') {
        const response = await fetch(`${API.getBaseUrl()}/${endpoint}?${params}`, {
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
            },
        });
        if (!response.ok) {
            throw new Error(`API error (${response.status})`);
        }
        const data = await response.json();
        return data;
    }

    static async getCandidats() {
        const data = await API.fetchResource(`candidats`);
        return data;
    }

    static async getFormateurs() {
        const data = await API.fetchResource(`formateurs`);
        return data;
    }

    static async getCreneaux() {
        const data = await API.fetchResource(`creneaux`);
        return data;
    }

    static async getUserCreneaux(user) {
        const data = await API.fetchResource(`formateurs/${user}/events`);
        return data;
    }

    static async getEvents(args = "") {
        const data = await API.fetchResource(`events`, args);
        return data;
    }

    static async getUserEvents(user, args = "") {
        const data = await API.fetchResource(`events/users/${user}`, args);
        return data;
    }

    static async getFormules() {
        const data = await API.fetchResource(`formules`);
        return data;
    }

    static async getTypePermis() {
        const data = await API.fetchResource(`type_permis`);
        return data;
    }

    static async postEvent(event) {
        const response = await fetch(`${API.getBaseUrl()}/events`, {
            method: 'POST',
            body: event,
        });
        return response; 
    }

    static async deleteEvent(id) {
        try {
            const response = await fetch(`${API.getBaseUrl()}/events/${id}`, {
                method: 'DELETE',
            });
            return response;
        }
        catch (error) {
            throw error;
        }
    }

    static async updateEvent(id, event) {
        try {
            const response = await fetch(`${API.getBaseUrl()}/events/${id}`, {
                headers: {
                    'Content-Type': 'application/json',
                },
                method: 'PUT',
                body: JSON.stringify(event),
            });
            return response;
        }
        catch (error) {
            throw error;
        }
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

