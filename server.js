import express from 'express';
import path from 'path';
import bodyParser from 'body-parser';
import cors from 'cors';
import processCsv from './processCsv.js';  // Ensure the relative path is correct
import http from 'http';
import { Server }  from 'socket.io'; // Import socket.io

const app = express();
const server = http.createServer(app); // Create an HTTP server
const io = new Server(server); // Integrate socket.io with the HTTP serve

// Enable CORS for cross-origin requests
app.use(cors());

// Parse JSON bodies
app.use(bodyParser.json());

// Root route to check server status
app.get('/', (req, res) => {
    res.send("Yes this is Ok");
});

// Correctly use POST here, not GET
app.post('/process', (req, res) => {
    const filePath = req.body.filepath; // Make sure you send "filepath" from frontend

    // Check if filepath is provided
    if (!filePath) {
        return res.status(400).json({ error: 'Filepath is required' });
    }

    // Log file path to console
    console.log('Received file path:', filePath);

    try {
        // Start processing CSV
        const result = processCsv(filePath,io);

        // Send response back
        res.json({
            data: result,
            message: 'Processing started',
            progress: 0,
        });
    } catch (err) {
        console.error('Error during CSV processing:', err);
        res.status(500).json({ error: 'Error processing CSV' });
    }
});

// Start server
server.listen(4000, '0.0.0.0', () => {
    console.log('Server running on http://0.0.0.0:4000');
});