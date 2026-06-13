import { CommonModule } from '@angular/common';
import { Component, inject } from '@angular/core';
import { InterfaceHousingLocation } from '../../interfaces/interface-housing-location';
import { ServiceHousingLocation } from '../../services/service-housing-location';
import { HousingLocation } from '../housing-location/housing-location';

@Component({
  selector: 'app-home',
  imports: [CommonModule, HousingLocation],
  templateUrl: './home.html',
  styleUrl: './home.css'
})
export class HomeComponent {
  housingLocationList: HousingLocation[] = [];
  housingService: ServiceHousingLocation = inject(ServiceHousingLocation);
  filteredLocationList: HousingLocation[] = [];

  constructor(){
    this.housingService.getAllHousingLocation().then((housingLocationList: HousingLocation[]) => {
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