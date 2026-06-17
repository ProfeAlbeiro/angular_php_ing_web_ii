import { Injectable } from '@angular/core';
import { InterfaceHousingLocation } from '../interfaces/interface-housing-location';

@Injectable({
  providedIn: 'root'
})
export class HousingLocationService {
  url = 'http://localhost/angular_php_ing_web_ii/backend/controllers/Locations.php';

  constructor() { }

  async getAllHousingLocation(): Promise<InterfaceHousingLocation[]> {
    try {
      const data = await fetch(this.url);
      if (!data.ok) {
        throw new Error(`Error HTTP: ${data.status}`);
      }
      const response = await data.json();
      return response.datos;
    } catch (error) {
      console.error('Error al obtener datos:', error);
      return [];
    }
  }

  async getHousingLocationById(id: number): Promise<InterfaceHousingLocation | undefined> {
    const url = `${this.url}/${id}`;
    console.log('URL de la API:', url);
    try {
      const data = await fetch(url);
      if (!data.ok) {
        throw new Error(`Error HTTP: ${data.status}`);
      }
      const response = await data.json();
      return response.datos.find((item: InterfaceHousingLocation) => item.id === id);
    } catch (error) {
      console.error('Error al obtener datos:', error);
      return undefined;
    }
  }

  submitApplication(firstName: string, lastName: string, email: string) {
    console.log(`FirstName: ${firstName} - LastName: ${lastName} - Email: ${email}`);
  }
}