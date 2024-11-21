const express = require('express');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.json());

// Controle de acesso baseado no tipo de usuário
app.post('/validate-access', (req, res) => {
    const { tipo_usuario } = req.body;

    if (!tipo_usuario) {
        return res.status(400).json({ error: 'Tipo de usuário não fornecido' });
    }

    switch (tipo_usuario) {
        case 1: // Administrador
            return res.json({ access: 'admin' });
        case 2: // Cliente
            return res.json({ access: 'client' });
        default: // Não autenticado
            return res.json({ access: 'guest' });
    }
});

// Porta do servidor
const PORT = 3001;
app.listen(PORT, () => console.log(`Auth service running on http://localhost:${PORT}`));
