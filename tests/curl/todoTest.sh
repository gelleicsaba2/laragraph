gq http://localhost:8000/graphql \
     -q 'query {todos (hash: "e4759dba15392d56d3f2db2d9198f68b", start: "2024-11-22") {success responseCode data { id todo todo_start todo_end uid } } }'
