import { CommonModule } from '@angular/common';
import { Component, inject } from '@angular/core';
import { InterfaceHousingLocation } from '../../interfaces/interface-housing-location';
import { HousingLocationService } from '../../services/service-housing-location';
import { HousingLocation } from '../housing-location/housing-location';

@Component({
  selector: 'app-home',
  imports: [CommonModule, HousingLocation],
  templateUrl: './home.html',
  styleUrl: './home.css'
})
export class Home {
  housingLocationList: InterfaceHousingLocation[] = [];
  housingService: HousingLocationService = inject(HousingLocationService);
  filteredLocationList: InterfaceHousingLocation[] = [];

  constructor(){
    this.housingService.getAllHousingLocation().then((housingLocationList: InterfaceHousingLocation[]) => {
      this.housingLocationList = housingLocationList;
      this.filteredLocationList = housingLocationList;
    })
  }

  filterResults(text:string){
    if (!text) {
      this.filteredLocationList = this.housingLocationList;
      return;
    }
    this.filteredLocationList = this.housingLocationList.filter((housingLocation) =>
      housingLocation?.city.toLowerCase().includes(text.toLowerCase())
    )
  }
}