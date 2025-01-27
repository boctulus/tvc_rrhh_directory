<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorController extends Controller
{   
    function index() {
        $areas    = [
            "Ingenieria Control de Acceso y Asistencia",
            "Ingenieria Redes / Ip / Cableado Estructurado / Bosch",
            "Ingenieria XYZ",
        ];
        
        $personal = json_decode('[
            {
                "id": 1,
                "name": "Jorge Alberto Garza Tovar",
                "position": "Coordinator of Engineering",
                "brands": "Dahua, Draytek",
                "certifications": "Access Zkteco (Security inspection line series ZKD, ZKX5000, ZKX6500, ZKX10080) video surveillance DHCA-VIS DHSA DHCA-ACS Transmission + DoLink Care",
                "lines_families": {
                    "dahua_cameras": 4,
                    "dahua_ip": 4,
                    "dahua_dvrs": 5,
                    "dahua_accessories": 4,
                    "dahua_access": 4,
                    "dahua_videoporteros": 5
                },
                "expertise": 4,
                "location": "NAY",
                "contact": "jorge.garza@tvc.mx",
                "phone": "81-84001777 #21421",
                "img_url": "https://i.imgur.com/3XtU7nl.jpeg",
                "areas": [
                    "Ingenieria Control de Acceso y Asistencia",
                    "Ingenieria Redes / Ip / Cableado Estructurado / Bosch"
                ]
            },
            {
                "id": 2,
                "name": "Gustavo Serrano Vazquez",
                "position": "Product Engineer",
                "brands": "Dahua, Tp-Link",
                "certifications": "Certifications in DHCA-VIS DHSA DHCA-ACS",
                "lines_families": {
                    "dahua_cameras": 5,
                    "dahua_ip": 5,
                    "dahua_dvrs": 5,
                    "dahua_access": 4,
                    "dahua_videoporteros": 5
                },
                "expertise": 5,
                "location": "IZT",
                "contact": "gustavo.serrano@tvc.mx",
                "phone": "81-84001777 #28057",
                "img_url": "https://i.imgur.com/VTO9nxU.jpeg",
                "areas": [                 
                    "Ingenieria Redes / Ip / Cableado Estructurado / Bosch"
                ]
            },
            {
                "id": 3,
                "name": "Jonathan Martin Sifuentes Reynosa",
                "position": "Product Engineer",
                "brands": "Dahua, Tp-Link",
                "certifications": "New staff",
                "lines_families": {
                    "dahua_access": 4,
                    "dahua_videoporteros": 5
                },
                "expertise": 4,
                "location": "OAX",
                "contact": "jonathan.sifuentes@tvc.mx",
                "phone": "81-84001777 #278115",
                "img_url": "https://i.imgur.com/kiENIcV.jpeg",
                "areas": [                 
                    "Ingenieria Redes / Ip / Cableado Estructurado / Bosch"
                ]
            },
            {
                "id": 4,
                "name": "Manuel Alejandro Gutierrez Alvarez",
                "position": "Product Engineer",
                "brands": "Dahua",
                "certifications": "New staff",
                "lines_families": {
                    "dahua_access": 4,
                    "dahua_videoporteros": 5
                },
                "expertise": 4,
                "location": "OAX",
                "contact": "manuel.gutierrez@tvc.mx",
                "phone": "81-84001000 #1111111",
                "img_url": "https://i.imgur.com/ietS1U4.jpeg",
                "areas": [
                    "Ingenieria Control de Acceso y Asistencia"                 
                ]
            },
            {
                "id": 5,
                "name": "Jennifer Olvera Hernandez",
                "position": "Product Engineer",
                "brands": "Dahua",
                "certifications": "Certifications in Transmission + DoLink Care DHSA DHCA-ACS",
                "lines_families": {
                    "dahua_networks": 5,
                    "dahua_alarms": 5,
                    "dahua_signage": 5
                },
                "expertise": 5,
                "location": "MTY",
                "contact": "jennifer.olvera@tvc.mx",
                "phone": "81-84001777 #231663",
                "img_url": "https://i.imgur.com/gBIGH7z.jpeg",
                "areas": [
                    "Ingenieria Control de Acceso y Asistencia",
                    "Ingenieria Redes / Ip / Cableado Estructurado / Bosch"
                ]
            },
            {
                "id": 6,
                "name": "Karen Esther Ontiveros Rojas",
                "position": "Product Engineer",
                "brands": "Dahua",
                "certifications": "Certifications in DHCA-VIS DHSA DHCA-ACS",
                "lines_families": {
                    "dahua_cameras": 4,
                    "dahua_ip": 5,
                    "dahua_dvrs": 5,
                    "dahua_accessories": 5,
                    "dahua_access": 4
                },
                "expertise": 5,
                "location": "MTY",
                "contact": "karen.ontiveros@tvc.mx",
                "phone": "81-84001777 #243213",
                "img_url": "https://i.imgur.com/hy30HwQ.jpeg",
                "areas": [
                    "Ingenieria Control de Acceso y Asistencia",
                    "Ingenieria Redes / Ip / Cableado Estructurado / Bosch"
                ]
            },
            {
                "id": 7,
                "name": "Karla Patricia Rocha Alonso",
                "position": "Product Engineer",
                "brands": "Dahua",
                "certifications": "Certifications in DHCA-VIS DHSA DHCA-ACS",
                "lines_families": {
                    "dahua_accessories": 3,
                    "dahua_access": 4
                },
                "expertise": 3,
                "location": "MTY",
                "contact": "karla.rocha@tvc.mx",
                "phone": "81-84001777 #27363",
                "img_url": "https://i.imgur.com/DQuLiZO.jpeg",
                "areas": [                 
                    "Ingenieria Redes / Ip / Cableado Estructurado / Bosch"
                ]
            },
            {
                "id": 8,
                "name": "Andrea Anette Celestino Castilla",
                "position": "Product Engineer",
                "brands": "Dahua",
                "certifications": "New staff",
                "lines_families": {
                    "dahua_accessories": 3,
                    "dahua_access": 3
                },
                "expertise": 3,
                "location": "MTY",
                "contact": "andrea.celestino@tvc.mx",
                "phone": "81-84001777 #260730",
                "img_url": "https://i.imgur.com/JVo7zPQ.jpeg",
                "areas": [
                    "Ingenieria Control de Acceso y Asistencia"                    
                ]
            },
            {
                "id": 9,
                "name": "Mario Gerardo Cruz Vargas",
                "position": "Product Engineer",
                "brands": "Dahua",
                "certifications": "New staff",
                "lines_families": {
                    "dahua_accessories": 3,
                    "dahua_access": 3
                },
                "expertise": 3,
                "location": "MTY",
                "contact": "mario.cruz@tvc.mx",
                "phone": "81-84001777 #270755",
                "img_url": "https://i.imgur.com/ka6mp0l.jpeg",
                "areas": [                 
                    "Ingenieria Redes / Ip / Cableado Estructurado / Bosch"
                ]
            },
            {
                "id": 10,
                "name": "Juan Guillermo Olvera Maldonado",
                "position": "Coordinator of Engineering",
                "brands": "Ubiquiti, Draytek, Tp-Link",
                "certifications": "Ubiquiti UEWA, UBWA Draytek: Discovery Tp-Link: OMADA",
                "lines_families": {
                    "ubiquiti_unifi": 5,
                    "ubiquiti_airmax": 4,
                    "draytek": 4,
                    "tp_link_omada": 3
                },
                "expertise": 4,
                "location": "MTY",
                "contact": "guillermo.olvera@tvc.mx",
                "phone": "81-84001777 #27663",
                "img_url": "https://i.imgur.com/rypuPUC.jpeg",
                "areas": [
                    "Ingenieria Control de Acceso y Asistencia"
                ]
            }
        ]', true);

        // var_export($personal);exit;
 
        return view('personal.grid', [
            'areas' => $areas,
            'personal' => $personal
        ]);
    }
}
