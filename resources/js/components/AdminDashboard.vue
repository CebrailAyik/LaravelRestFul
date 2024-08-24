<template>
    <div class="container-fluid">
        <div class="row">
            <!-- Sol Menü -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <h4 class="ms-3 mt-3">Admin Dashboard</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" @click="view = 'companies'" class="nav-link" :class="{ active: view === 'companies' }">
                                Company List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" @click="view = 'employees'" class="nav-link" :class="{ active: view === 'employees' }">
                                Employee List
                            </a>
                        </li>
                    </ul>
                    <button @click="logout" class="btn btn-danger mt-3 w-100">Logout</button>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <company-list v-if="view === 'companies'" @show-add-company-form="view = 'addCompany'" @company-added="view = 'companies'"></company-list>
                <employee-list v-if="view === 'employees'" @show-add-employee-form="view = 'addEmployee'" @employee-added="view = 'employees'"></employee-list>
                <company-add v-if="view === 'addCompany'" @company-added="view = 'companies'" @cancel="view = 'companies'"></company-add>
                <employee-add v-if="view === 'addEmployee'" @employee-added="view = 'employees'" @cancel="view = 'employees'"></employee-add>
            </main>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import CompanyList from './CompanyList.vue';
import EmployeeList from './EmployeeList.vue';
import CompanyAdd from './CompanyAdd.vue';
import EmployeeAdd from './EmployeeAdd.vue';

export default {
    components: {
        CompanyList,
        EmployeeList,
        CompanyAdd,
        EmployeeAdd
    },
    data() {
        return {
            view: 'companies'
        };
    },
    methods: {
        async logout() {
            try {
                await axios.post('/api/logout');
                localStorage.removeItem('token');
                delete axios.defaults.headers.common['Authorization'];
                this.$router.push('/login');
            } catch (error) {
                console.error('Logout failed', error);
            }
        }
    }
};
</script>

<style scoped>
.sidebar {
    height: 100vh;
    position: fixed;
}

.nav-link.active {
    font-weight: bold;
    color: #007bff;
}

.container-fluid {
    padding: 0;
}

main {
    margin-left: 200px;
    padding-top: 20px;
}
</style>
