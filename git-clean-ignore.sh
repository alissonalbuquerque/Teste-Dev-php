#!/bin/bash

echo "Removendo arquivos ignorados do versionamento..."

# Gera uma lista de arquivos ignorados que ainda estão sendo versionados
git ls-files -i --exclude-standard | while read -r file; do
  echo "→ Removendo do versionamento: $file"
  git rm --cached "$file"
done

echo "✔️ Concluído! Agora é só fazer commit e push."
