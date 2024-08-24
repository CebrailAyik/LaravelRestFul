<template>
    <div class="d-flex justify-content-center mt-5">
        <div class="form-container">
            <h2 class="text-center mb-4">Yeni Şirket Ekle</h2>
            <form @submit.prevent="addCompany">
                <div class="mb-3">
                    <label for="name" class="form-label">Şirket Adı</label>
                    <input type="text" id="name" v-model="company.name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" v-model="company.email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Şirket Logo</label>
                    <input type="file" id="logo" @change="handleFileUpload" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="website" id="website" v-model="company.website" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
                <button @click="cancel" type="button" class="btn btn-secondary ms-2">Vazgeç</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            company: {
                name: '',
                email: '',
                logo: null,
                website: ''
            }
        };
    },
    methods: {
        handleFileUpload(event) {
            this.company.logo = event.target.files[0];
        },
        async addCompany() {
            const formData = new FormData();
            formData.append('name', this.company.name);
            formData.append('email', this.company.email);
            formData.append('logo', this.company.logo);
            formData.append('website', this.company.website);

            try {
                await axios.post('/api/companies', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                this.$emit('company-added');
            } catch (error) {
                console.error('Error adding company', error);
            }
        },
        cancel() {
            this.$emit('cancel');
        }
    }
};
</script>

<style scoped>
.d-flex {
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-container {
    width: 50%;
}

.text-center {
    text-align: center;
}
</style>

