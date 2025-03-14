<x-app-layout title="Days Chart">
	<x-slot name="header">
		Days Chart
	</x-slot>

	<x-card>
        <div class="h-[70vh]">
    		<canvas id="chart"></canvas>
        </div>
	</x-card>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript">
	const ctx = document.getElementById('chart');

	//converts json to js object
	const tracks = {{ Js::from($tracks) }};

    //get list of first and last dates for each season
    const firstDates = Object.keys(tracks).map((season) => tracks[season][0].date);
    const lastDates = Object.keys(tracks).map((season) => tracks[season][tracks[season].length - 1].date);
    //Get earliest and latest dates. Hard coding leap year.
    const earliest = new Date(Math.min(...firstDates.map((date) => new Date(`2023/${date}`))));
    const latest = new Date(Math.max(...lastDates.map((date) => new Date(`2024/${date}`))));
    const xLabels = [];

    //make labels for all dates, with earliest and latest found
	for (let d = new Date(earliest); d <= latest; d.setDate(d.getDate() + 1)) {
		const month = (d.getMonth() + 1).toString();
		const day = d.getDate().toString();
		xLabels.push(`${month}/${day}`);
	}

    //create datasets for each season
    const datasets = Object.keys(tracks).map((season) => {
		//for each label
        const data = xLabels.map((date) => {
			//see if this date has an entry
            const track = tracks[season].find(track => track.date === date);
            return track ? track.name : null;
        });

        return {
            label: season,
            data: data
        };
    });

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: xLabels,
            datasets: datasets
        },
        options: {
			spanGaps: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Day #'
                    }
                }
            }
        }
    });
	</script>

</x-app-layout>