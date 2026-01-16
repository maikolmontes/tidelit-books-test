import { Text, View, Button, FlatList } from 'react-native'
import { useEffect, useState } from 'react'

interface Book {
  title: string
  author: string
  published_year: number
  average_rating: number | null
}

export default function App() {
  const [books, setBooks] = useState<Book[]>([])

  async function loadBooks() {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/books')
      console.log('STATUS:', response.status)

      const text = await response.text()
      console.log('RAW RESPONSE:', text)

      const data = JSON.parse(text)
      setBooks(data)
    } catch (error) {
      console.log('ERROR:', error)
    }
  }


  useEffect(() => {
    loadBooks()
  }, [])

  return (
    <View style={{ padding: 22 }}>
      <Text style={{ fontSize: 24 }}>Libros</Text>

      <Button title="Refrescar" onPress={loadBooks} />

      <Text>Libros cargados: {books.length}</Text>

      {books.map((book) => (
        <Text key={book.title}>
          {book.title} - Rating: {book.average_rating}
        </Text>
      ))}
    </View>
  )
}
