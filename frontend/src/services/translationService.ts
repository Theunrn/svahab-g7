
import axios from 'axios';

const API_KEY = 'AIzaSyD3MHm7Acamzs_iQlVWtEq3bHc73hM_KgI';
const BASE_URL = 'https://translation.googleapis.com/language/translate/v2';

export const translateText = async (text: string, targetLang: string) => {
  try {
    const response = await axios.post(BASE_URL, {
      q: text,
      target: targetLang,
      key: API_KEY
    }, {
      headers: {
        'Content-Type': 'application/json'
      }
    });
    return response.data.data.translations[0].translatedText;
  } catch (error) {
    console.error('Translation API error:', error);
    throw new Error('Translation failed');
  }
};
