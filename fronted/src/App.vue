<template>
  <div>
    <h1>Libros</h1>

    <button @click="loadBooks">Refrescar</button>

    <ul>
      <li v-for="book in books" :key="book.title">
        {{ book.title }} - Rating promedio: {{ book.average_rating }}
      </li>
    </ul>

    <p v-if="error">{{ error }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { fetchBooks } from './services/bookService'
import type { Book } from './types/Book'

export default defineComponent({
  data() {
    return {
      books: [] as Book[],
      error: null as string | null
    }
  },
  methods: {
    async loadBooks(): Promise<void> {
      try {
        this.books = await fetchBooks()
      } catch (e) {
        this.error = 'No se pudieron cargar los libros'
      }
    }
  },
  mounted() {
    this.loadBooks()
  }
})
</script>
