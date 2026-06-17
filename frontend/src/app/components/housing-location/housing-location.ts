import { CommonModule } from '@angular/common';
import { Component, Input } from '@angular/core';
import { RouterModule } from '@angular/router';
import { InterfaceHousingLocation } from '../../interfaces/interface-housing-location';

@Component({
  selector: 'app-housing-location',
  imports: [RouterModule, CommonModule],
  templateUrl: './housing-location.html',
  styleUrl: './housing-location.css'
})
export class HousingLocation {
  @Input() housingLocation!: InterfaceHousingLocation;
}