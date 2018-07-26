create database VrVideos;

create table Markers(
id bigint identity(1,1) primary key,
title varchar(100),
lat decimal(8,6),
lng decimal(8,6)
);

select Buses.BusOperator , BusDetails.DepartFrom , BusDetails.DepartTo , Buses.BusType , Buses.Amenities , BusDetails.BoardingPoint , BusDetails.DroppingPoint,  BusDetails.DepartTime , BusDetails.ArriveTime, BusDetails.Duration , BusDetails.price , Buses.Ratings
              from [VrVideos].[dbo].[Buses]
              left join [VrVideos].[dbo].[BusDetails] on [Buses].BusId = [BusDetails].BusId
              where 1 =1 and DepartFrom like 'udaipur';

insert into [VrVideos].[dbo].[Markers]
values('Gangaur Ghat',24.579924 , 73.681926);
insert into [VrVideos].[dbo].[Markers]
values('Rani Road', 24.595267, 73.665000);
insert into [VrVideos].[dbo].[Markers]
values('Pratap Gaurav Kendra', 24.626558, 73.671387);


select * from [VrVideos].[dbo].[Markers];
select * from [VrVideos].[dbo].[Sheet2$];
select * from [VrVideos].[dbo].BusDetails;


create table Buses(
BusId bigint identity(1,1) primary key,
BusOperator varchar(100),
BusType varchar(200),
Amenities varchar(200),
Ratings varchar(10)
);



create table BusDetails(
BusId bigint foreign key references Buses(BusId),
DepartFrom varchar(50),
DepartTo varchar(50),
DepartTime time,
ArriveTime time,
Duration varchar(50),
BoardingPoint varchar(200),
DroppingPoint varchar(200),
price decimal(10,2) 
);



insert into Buses
select [travel operator name]
      ,[A/C or Non A/C]
      ,[Amenities]
      ,[ratings]
from [VrVideos].[dbo].[Sheet1$]

insert into BusDetails
select [bus id]
      ,[from]
      ,[to]
      ,[departure time]
      ,[arrival time]
      ,[duration time]
      ,[boarding points]
      ,[dropping points]
      ,[price INR]
	  from [VrVideos].[dbo].[Sheet2$]

