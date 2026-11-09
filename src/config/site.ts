// Datos de contacto centralizados: cambiarlos aquí los actualiza en todo el sitio.
export const SITE_URL = "https://psicologaameliareyes.com";

export const PHONE_DISPLAY = "+506 6058 7256";
export const PHONE_SCHEMA = "+506-6058-7256";
export const EMAIL = "psicoameliareyes@gmail.com";
export const INSTAGRAM_URL = "https://www.instagram.com/ame.psicomamaypareja/";

const WHATSAPP_NUMBER = "50660587256";
export const WHATSAPP_URL = `https://wa.me/${WHATSAPP_NUMBER}`;

/** Link de WhatsApp con mensaje pre-escrito. */
export const whatsappLink = (message: string) =>
  `${WHATSAPP_URL}?text=${encodeURIComponent(message)}`;
