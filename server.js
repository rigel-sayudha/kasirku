const express = require('express');
const bodyParser = require('body-parser');
const { Configuration, OpenAIApi } = require('openai');

const app = express();
const port = 3000;

app.use(bodyParser.json());
app.use('/kasirku', express.static('public')); // Untuk melayani file statis dari folder 'public'

// Use environment variable for API key; fallback removed for security
const configuration = new Configuration({
    apiKey: process.env.OPENAI_API_KEY || 'REDACTED_OPENAI_KEY',
});
const openai = new OpenAIApi(configuration);

app.post('/kasirku/api', async (req, res) => {
    const question = req.body.question;

    try {
        const completion = await openai.createCompletion({
            model: "text-davinci-003",
            prompt: question,
            max_tokens: 150,
        });

        const answer = completion.data.choices[0].text.trim();
        res.json({ answer: answer });
    } catch (error) {
        console.error('Error with OpenAI API:', error);
        res.status(500).json({ error: 'Internal Server Error' });
    }
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});