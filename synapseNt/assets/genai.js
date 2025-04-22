// genai.js
import { GoogleGenAI } from 'https://esm.run/@google/genai';

const ai = new GoogleGenAI({ apiKey: '' });

async function generateContent(msg) {
  try {
    const response = await ai.models.generateContent({
      model: 'gemini-2.0-flash',
      contents: msg,
    });
    console.log(response.text)
    return response.text;
    // You can also send this result to the server using AJAX if needed.
  } catch (error) {
    console.error('Error generating content:', error);
    return 'An error occurred while generating content. Please try again later.';
  }
}
