<template>
    <div class="d-flex justify-content-center mt-5">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-center">Çalışan Listesi</h2>
                <button @click="showAddEmployeeForm" class="btn btn-success">Ekle</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Email</th>
                        <th>Şirket</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                        <td>{{ employee.id }}</td>
                        <td>{{ employee.first_name }}</td>
                        <td>{{ employee.last_name }}</td>
                        <td>{{ employee.email }}</td>
                        <td>{{ employee.company ? employee.company.name : '-' }}</td>
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
            employees: [],
            pagination: {
                prev: null,
                next: null,
                current_page: 1
            }
        };
    },
    mounted() {
        this.fetchEmployees();
    },
    methods: {
        fetchEmployees(page = 1) {
            axios.get(`/api/employees?page=${page}`).then(response => {
                this.employees = response.data.data;
                this.pagination.prev = response.data.links.prev;
                this.pagination.next = response.data.links.next;
                this.pagination.current_page = response.data.meta.current_page;
            });
        },
        nextPage() {
            if (this.pagination.next) {
                this.fetchEmployees(this.pagination.current_page + 1);
            }
        },
        prevPage() {
            if (this.pagination.prev) {
                this.fetchEmployees(this.pagination.current_page - 1);
            }
        },
        showAddEmployeeForm() {
            this.$emit('show-add-employee-form');
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
