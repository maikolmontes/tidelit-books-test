import type { Book } from '../types/Book'

const API_URL = 'http://127.0.0.1:8000/api/books'

export async function fetchBooks(): Promise<Book[]> {
    const response = await fetch(API_URL)

    if (!response.ok) {
        throw new Error('Error al cargar los libros')
    }

    return await response.json()
}
