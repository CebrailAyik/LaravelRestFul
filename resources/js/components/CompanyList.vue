<style scoped>
.d-flex {
    display: flex;
    justify-content: center;
    align-items: center;
}

.table-container {
    width: 100%;
}
.table-responsive {
    max-height: 500px;
    overflow-y: auto;
}

.table {
    margin: 0 auto;
}

.text-center {
    text-align: center;
}
</style>

<template>
    <div class="d-flex justify-content-center mt-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-center">Şirket Listesi</h2>
                <button @click="showAddCompanyForm" class="btn btn-success">Ekle</button>
            </div>
            <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Email</th>
                    <th>Logo</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="company in companies" :key="company.id">
                    <td>{{ company.id }}</td>
                    <td>{{ company.name }}</td>
                    <td>{{ company.email }}</td>
                    <td><img :src="`${company.logo}`" alt="Logo" style="width: 50px; height: auto;"></td>
                </tr>
                </tbody>
            </table>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button @click="prevPage" class="btn btn-primary" :disabled="!pagination.prev">Previous</button>
                <button @click="nextPage" class="btn btn-primary" :disabled="!pagination.next">Next</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            companies: [],
            pagination: {
                prev: null,
                next: null,
                current_page: 1
            }
        };
    },
    mounted() {
        this.fetchCompanies();
    },
    methods: {
        fetchCompanies(page = 1) {
            axios.get(`/api/companies?page=${page}`).then(response => {
                this.companies = response.data.data;
                this.pagination.prev = response.data.links.prev;
                this.pagination.next = response.data.links.next;
                this.pagination.current_page = response.data.meta.current_page;
            });
        },
        nextPage() {
            if (this.pagination.next) {
                this.fetchCompanies(this.pagination.current_page + 1);
            }
        },
        prevPage() {
            if (this.pagination.prev) {
                this.fetchCompanies(this.pagination.current_page - 1);
            }
        },
        showAddCompanyForm() {
            this.$emit('show-add-company-form');
        }
    }
};
</script>
