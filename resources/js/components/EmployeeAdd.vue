<template>
  <div class="d-flex justify-content-center mt-5">
    <div class="form-container">
    <h2 class="text-center mb-4">Yeni Çalışan Ekle</h2>
    <form @submit.prevent="addEmployee">
      <div class="mb-3">
        <label for="first_name" class="form-label">Ad</label>
        <input type="text" v-model="form.first_name" class="form-control" id="first_name" required>
      </div>
      <div class="mb-3">
        <label for="last_name" class="form-label">Soyad</label>
        <input type="text" v-model="form.last_name" class="form-control" id="last_name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" v-model="form.email" class="form-control" id="email" required>
      </div>
      <div class="mb-3">
        <label for="company_id" class="form-label">Şirket</label>
        <select v-model="form.company_id" class="form-control" id="company_id" required>
          <option v-for="company in companies" :key="company.id" :value="company.id">
            {{ company.name }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Telefon</label>
        <input type="phone" v-model="form.phone" class="form-control" id="phone" required>
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
      form: {
        first_name: '',
        last_name: '',
        email: '',
        company_id: '',
        phone: ''
      },
      companies: []
    };
  },
  mounted() {
    this.fetchAllCompanies();
  },
  methods: {
    fetchAllCompanies() {
      axios.get('/api/all-companies').then(response => {
        this.companies = response.data;
      });
    },
    async addEmployee() {
      const formData = new FormData();
      formData.append('first_name', this.form.first_name);
      formData.append('last_name', this.form.last_name);
      formData.append('email', this.form.email);
      formData.append('company_id', this.form.company_id);
      formData.append('phone', this.form.phone);

      try {
        await axios.post('/api/employees', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });
        this.$emit('employee-added');
      } catch (error) {
        console.error('Hata oluştu', error);
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

