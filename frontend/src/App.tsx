import type { Machine } from './types/machine';
import Header from './components/organisms/Header/Header';
import MachineGrid from './components/organisms/MachineGrid/MachineGrid';

const machines: Machine[] = [
  { name: 'Machine A', state: 'PRODUCING' },
  { name: 'Machine B', state: 'IDLE' },
  { name: 'Machine C', state: 'STARVED' },
];

function App() {
  return (
    <div>
      <Header />
      <MachineGrid machines={machines} />
    </div>
  );
}

export default App;
