export function generateContinuousIntervals(intervals) {
    const continuousIntervals = [];
    intervals.sort((a, b) => a.jour_semaine - b.jour_semaine || a.heure_debut.localeCompare(b.heure_debut));

    let currentDay = -1;
    let currentContinuousInterval = null;

    for (const interval of intervals) {
        if (interval.jour_semaine !== currentDay) {
            if (currentContinuousInterval) {
                continuousIntervals.push(currentContinuousInterval);
            }
            currentDay = interval.jour_semaine;
            currentContinuousInterval = {
                daysOfWeek: [currentDay],
                startTime: interval.heure_debut,
                endTime: interval.heure_fin,
            };
        } else {
            if (interval.heure_debut == currentContinuousInterval.endTime)
                currentContinuousInterval.endTime = interval.heure_fin;
            else {
                continuousIntervals.push(currentContinuousInterval);
                currentContinuousInterval = {
                    daysOfWeek: [currentDay],
                    startTime: interval.heure_debut,
                    endTime: interval.heure_fin,
                };
            }
        }
    }

    // Ajoutez le dernier interval continu au tableau
    if (currentContinuousInterval) {
        continuousIntervals.push(currentContinuousInterval);
    }

    return continuousIntervals;
}

export function isAvailable(formateur, numero_jour, heure_debut, heure_fin) { 
    
    if(!formateur.creneaux[numero_jour]) return false;

    const intervals = generateContinuousIntervals(formateur.creneaux[numero_jour]);
    const start = generateDateFromTime(heure_debut);
    const end = generateDateFromTime(heure_fin);

    let isAvailable = false;

    for (const interval of intervals) {
        const intervalStart = generateDateFromTime(interval.startTime);
        const intervalEnd = generateDateFromTime(interval.endTime);
        
        if (start >= intervalStart && end <= intervalEnd) {
            isAvailable = true;
            break;
        }
    }

    return isAvailable;
}

function generateDateFromTime(time) {
    const [hours, minutes, seconds] = time.split(':');
    const currentDate = new Date();
    
    return new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), hours, minutes, seconds || 0);
}

function stringMax(str1, str2) {
    return str1.localeCompare(str2) > 0 ? str1 : str2;
}

function stringMin(str1, str2) {
    return str1.localeCompare(str2) < 0 ? str1 : str2;
}

export function intersect(start1, end1, start2, end2) {
    return stringMax(start1, start2) < stringMin(end1, end2);
}