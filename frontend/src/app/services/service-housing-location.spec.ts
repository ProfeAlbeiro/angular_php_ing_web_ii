import { TestBed } from '@angular/core/testing';

import { ServiceHousingLocation } from './service-housing-location';

describe('ServiceHousingLocation', () => {
  let service: ServiceHousingLocation;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ServiceHousingLocation);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
