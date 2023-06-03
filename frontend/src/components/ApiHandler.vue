<template>
  <div>
    <form @submit.prevent="addRecord">
      <label>Name:</label>
      <input v-model="name" type="text" required />
      <label>Email:</label>
      <input v-model="email" type="email" required />
      <button type="submit">Add Record</button>
    </form>

    <div>
      <input v-model="removeId" type="number" />
      <button @click="removeRecord(removeId)">Remove User by ID</button>
    </div>

    <div>

      <table v-if="users.length > 0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
          </tr>
        </tbody>
      </table>
      <p v-else>No users found.</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      removeId: null,
      users: [],
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      fetch("http://localhost:8000/index.php")
        .then((response) => response.json())
        .then((data) => {
          this.users = data;
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    },
    addRecord() {
      const formData = new FormData();
      formData.append("action", "add");
      formData.append("data[name]", this.name);
      formData.append("data[email]", this.email);

      fetch("http://localhost:8000/index.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((message) => {
          console.log(message);
          this.fetchUsers();
          this.name = "";
          this.email = "";
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    },
    removeRecord(id) {
      const formData = new FormData();
      formData.append("action", "remove");
      formData.append("id", id);

      fetch("http://localhost:8000/index.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((message) => {
          console.log(message);
          this.fetchUsers();
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    },
    fetchAllUsers() {
      fetch("http://localhost:8000/index.php")
        .then((response) => response.json())
        .then((data) => {
          this.users = data;
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    },
  },
};
</script>
